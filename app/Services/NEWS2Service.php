<?php

namespace App\Services;

class NEWS2Service
{
    /**
     * Calculate NEWS2 score and risk level
     */
    public static function calculate(array $vitals): array
    {
        $score = 0;
        $missing = false;

        // Respiratory Rate (8-25+)
        if (isset($vitals['respiratory_rate'])) {
            $rr = (int) $vitals['respiratory_rate'];
            if ($rr <= 8 || $rr >= 25) $score += 3;
            elseif ($rr >= 21) $score += 2;
            elseif ($rr <= 11) $score += 1;
        } else {
            $missing = true;
        }

        // SpO2 (Scale 1)
        if (isset($vitals['spo2'])) {
            $spo2 = (int) $vitals['spo2'];
            if ($spo2 <= 91) $score += 3;
            elseif ($spo2 <= 93) $score += 2;
            elseif ($spo2 <= 95) $score += 1;
        } else {
            $missing = true;
        }

        // Supplemental Oxygen
        if (!empty($vitals['supplemental_oxygen'])) {
            $score += 2;
        }

        // Systolic BP
        if (isset($vitals['bp_sys'])) {
            $sbp = (int) $vitals['bp_sys'];
            if ($sbp <= 90 || $sbp >= 220) $score += 3;
            elseif ($sbp <= 100) $score += 2;
            elseif ($sbp <= 110) $score += 1;
        } else {
            $missing = true;
        }

        // Heart Rate
        if (isset($vitals['pulse'])) {
            $hr = (int) $vitals['pulse'];
            if ($hr <= 40 || $hr >= 131) $score += 3;
            elseif ($hr >= 111) $score += 2;
            elseif ($hr <= 50 || $hr >= 91) $score += 1;
        } else {
            $missing = true;
        }

        // Consciousness (ACVPU)
        if (isset($vitals['consciousness'])) {
            if ($vitals['consciousness'] !== 'A') $score += 3;
        }

        // Temperature
        if (isset($vitals['temp'])) {
            $temp = (float) $vitals['temp'];
            if ($temp <= 35.0) $score += 3;
            elseif ($temp >= 39.1) $score += 2;
            elseif ($temp <= 36.0 || $temp >= 38.1) $score += 1;
        } else {
            $missing = true;
        }

        return [
            'score' => $score,
            'missing_params' => $missing,
            'risk_level' => self::getRiskLevel($score)
        ];
    }

    private static function getRiskLevel(int $score): string
    {
        if ($score === 0) return 'LOW';
        if ($score <= 4) return 'LOW';
        if ($score <= 6) return 'MEDIUM';
        return 'HIGH';
    }
}
