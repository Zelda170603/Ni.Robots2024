<?php

use App\Http\Middleware\Administrador;
use App\Http\Middleware\Fabricante;
use App\Http\Middleware\Doctor;
use App\Http\Middleware\EnsureSessionIsCurrent; // <- este nombre exacto
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(['/']);

        // que corra para TODO el grupo web
        $middleware->appendToGroup('web', EnsureSessionIsCurrent::class);

        $middleware->alias([
            'admin'            => Administrador::class,
            'fabricante'       => Fabricante::class,
            'doctor'           => Doctor::class,
            'session.current'  => EnsureSessionIsCurrent::class, // opcional
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
