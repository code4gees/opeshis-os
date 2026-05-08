<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstitutionalSecurity
{
    /**
     * Handle an incoming request.
     * Enforce strict security headers for the Opeshis OS Kernel.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 1. Content Security Policy (CSP)
        // Restricting scripts to trusted sources and self.
        $csp = "default-src 'self'; ";
        $csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://fonts.googleapis.com; ";
        $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
        $csp .= "font-src 'self' https://fonts.gstatic.com; ";
        $csp .= "img-src 'self' data: https://images.unsplash.com; ";
        $csp .= "frame-src 'none'; ";
        $csp .= "object-src 'none';";

        $response->headers->set('Content-Security-Policy', $csp);

        // 2. Anti-Clickjacking (X-Frame-Options)
        $response->headers->set('X-Frame-Options', 'DENY');

        // 3. XSS Protection
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // 4. MIME Type Sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // 5. Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // 6. HSTS (Strict-Transport-Security) - Only for Production/HTTPS
        if ($request->isSecure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }
}
