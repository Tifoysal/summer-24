<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'customer_auth' => \App\Http\Middleware\CustomerAuth::class,
           
        ]);
        $middleware->alias([
            'changeLangMiddleware' => \App\Http\Middleware\ChangeLanguageMiddleware::class,
        ]);
        
        $middleware->alias([
            'check_permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/success',
            '/cancel',
            '/fail',
            '/ipn',
            '/pay-via-ajax',
        ]);
    })

    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
