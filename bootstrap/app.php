<?php

use App\Http\Middleware\AdminVerification;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //$middleware->append(AdminVerification::class);
        //$middleware->append(\Illuminate\Http\Middleware\HandleCors::class);
        $middleware->alias([
            'admin' => AdminVerification::class,
            'cors'=>\App\Http\Middleware\CorsMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'payement-gateway/*',
            'http://example.com/foo/bar',
            'http://example.com/foo/*',
        ]);
       /* $middleware->api(append:[
            App\Http\Middleware\AdminVerification::class
        ]);*/
        $middleware->web(append:[
            App\Http\Middleware\VerifyCsrfToken::class, 
           'localization'=> \App\Http\Middleware\Localization::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
