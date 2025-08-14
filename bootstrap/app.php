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
        // Register route middleware aliases
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'siswa' => \App\Http\Middleware\SiswaMiddleware::class,
            'last_activity' => \App\Http\Middleware\LastUserActivity::class,
        ]);

        // Add to web group so every web request updates activity when authenticated
        $middleware->appendToGroup('web', [
            'last_activity',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
