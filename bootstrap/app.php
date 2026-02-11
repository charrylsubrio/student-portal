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

    // 🔥 REGISTER CUSTOM MIDDLEWARE ALIASES HERE
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'nocache' => \App\Http\Middleware\NoCacheMiddleware::class, // 🔒 prevent back-button after logout
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();