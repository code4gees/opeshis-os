<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Check using Model logic (Bypass and Fallbacks are internal to User::hasPermission)
        if (!$user->hasPermission($permission)) {
            \Illuminate\Support\Facades\Log::warning("Access Denied: User {$user->id} ({$user->role}) attempted to access {$permission}");
            abort(403, "Opeshis OS: Institutional access denied. Missing permission: {$permission}");
        }

        return $next($request);
    }
}
