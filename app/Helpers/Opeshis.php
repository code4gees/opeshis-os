<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Opeshis
{
    /**
     * Decrypt Personally Identifiable Information (PII) using legacy logic.
     */
    public static function decryptPII($val)
    {
        if ($val === null) return '';
        
        // Handle postgres hex format compatibility
        if (is_string($val) && str_starts_with($val, '\x')) {
            return hex2bin(substr($val, 2));
        }

        if (empty($val)) return $val;
        
        try {
            $secret = config('app.secret', env('APP_SECRET', 'opeshis_secret_key_v2.1'));
            $decoded = base64_decode($val, true);
            if ($decoded === false) return $val; 
            
            $iv_len = openssl_cipher_iv_length('aes-256-cbc');
            if (strlen($decoded) < $iv_len) return $val;
            
            $iv = substr($decoded, 0, $iv_len);
            $encrypted = substr($decoded, $iv_len);

            // Try decrypting (Raw Data)
            $decrypted = @openssl_decrypt($encrypted, 'aes-256-cbc', $secret, OPENSSL_RAW_DATA, $iv);
            if ($decrypted !== false) return $decrypted;

            // Try legacy mode
            $decrypted = @openssl_decrypt($encrypted, 'aes-256-cbc', $secret, 0, $iv);
            if ($decrypted !== false) return $decrypted;
            
            return $val;
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('PII Decryption Failure: ' . $e->getMessage());
            return '*** DECRYPTION ERROR ***';
        }
    }

    /**
     * Encrypt Personally Identifiable Information (PII)
     */
    public static function encryptPII($val)
    {
        if (empty($val)) return $val;
        if (!is_string($val)) {
            $val = json_encode($val);
        }
        $secret = config('app.secret', env('APP_SECRET', 'opeshis_secret_key_v2.1'));
        $iv_len = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($iv_len);
        $encrypted = openssl_encrypt($val, 'aes-256-cbc', $secret, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }

    /**
     * Generate Search Hash (Blind Indexing)
     */
    public static function generateSearchHash($text)
    {
        if (!$text) return null;
        // Normalize: lowercase, remove special chars, trim
        $normalized = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $text));
        return hash('sha256', $normalized . env('APP_SECRET', 'opeshis_secret_key_v2.1'));
    }

    /**
     * Log Institutional Action (Audit Trail)
     */
    public static function logAction($action, $module, $resourceId = null, $payload = [])
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'table_name' => $module,
            'record_id' => $resourceId,
            'details' => $payload,
            'ip_address' => request()->ip(),
        ]);
    }
}
