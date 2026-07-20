<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 'guests' = redirect user belum login ke halaman login
        // 'users'  = redirect user sudah login tapi akses halaman guest (mis. /login)
        // Gunakan /login (standalone route) bukan /auth/login (ada di grup guest) agar tidak loop
        $middleware->redirectTo(guests: '/login', users: '/login');
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
