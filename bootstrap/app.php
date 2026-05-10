<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
        $middleware->append(\App\Http\Middleware\InstitutionalSecurity::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle 419 (Page Expired / CSRF Mismatch)
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, Request $request) {
            return redirect()->back()
                ->withInput($request->except('password', '_token'))
                ->with('error', 'Security token expired. Please try again.');
        });

        // Handle 403 (Forbidden)
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized access denied.'], 403);
            }
            return response()->view('errors.403', [], 403);
        });

        // Handle 404 (Not Found)
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, Request $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'The requested resource could not be located.'], 404);
            }
            // If authenticated and hitting a missing internal route, redirect to dashboard
            if (Auth::check()) {
                return redirect()->route('dashboard')->with('warning', 'The page you were looking for does not exist.');
            }
            return response()->view('errors.404', [], 404);
        });

        // Handle 500 (Internal Server Error)
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return null; // Let Laravel handle validation redirects
            }

            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                return null; // Let default handler handle other HTTP exceptions
            }
            
            Log::critical('Institutional System Error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'url' => $request->fullUrl(),
            ]);

            if ($request->expectsJson()) {
                return response()->json(['message' => 'A critical system error occurred. Our engineering team has been notified.'], 500);
            }

            return response()->view('errors.500', [], 500);
        });
    })->create();
