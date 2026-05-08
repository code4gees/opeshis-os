<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Actions\Auth\SendInstitutionalOtpAction;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Show Institutional Login Gateway
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Authorize Institutional Login Protocol
     */
    public function login(Request $request, SendInstitutionalOtpAction $otpAction): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($request->password, $user->password_hash)) {
            // ── MFA DISABLED (re-enable when requested) ──────────────────────
            // $otpAction->execute($user);
            // session(['mfa_user_id' => $user->id]);
            // return redirect()->route('login.otp')->with('info', 'Institutional security code dispatched.');
            // ─────────────────────────────────────────────────────────────────

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    /**
     * Finalize Institutional Exit Protocol
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show Institutional MFA/OTP Verification Interface
     */
    public function showOtpForm(): View|RedirectResponse
    {
        if (!session('mfa_user_id')) return redirect()->route('login');
        return view('auth.otp');
    }

    /**
     * Authorize Institutional OTP Verification Protocol
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $userId = session('mfa_user_id');
        if (!$userId) return redirect()->route('login');

        $user = User::find($userId);
        
        if ($user && $user->two_factor_code === $request->input('otp') && now()->lt($user->two_factor_expires_at)) {
            // Finalize Secure Boundary
            $user->update([
                'two_factor_code' => null,
                'two_factor_expires_at' => null
            ]);

            Auth::login($user);
            session()->forget('mfa_user_id');
            
            if (in_array($user->role, ['Admin'])) {
                return redirect('/admin');
            }
            
            return redirect('/dashboard');
        }

        return redirect()->back()->with('error', 'Invalid or expired institutional OTP.');
    }
}
