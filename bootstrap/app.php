<?php

use App\Http\Middleware\Administrador;
use App\Http\Middleware\Fabricante;
use App\Http\Middleware\Doctor;
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
        $middleware->alias([
            "admin" => Administrador::class,
            "fabricante" => Fabricante::class,
            "doctor" => Doctor::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
    })->create();
