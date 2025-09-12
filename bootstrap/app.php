<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'driver_or_user' => \App\Http\Middleware\CheckDriverOrUser::class,
            'supervisor_or_manager' => \App\Http\Middleware\CheckSupervisorOrManager::class,
            'mechanic' => \App\Http\Middleware\CheckMechanic::class,
            'transport_officer' => \App\Http\Middleware\CheckTransportOfficer::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
