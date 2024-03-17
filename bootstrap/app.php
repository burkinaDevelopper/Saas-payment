<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\{
    RedirectIfSubscribe,
    RedirectIfNotPremium,
    RedirectIfNotSubscribe
};
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'redirect.subscribed'=>RedirectIfSubscribe::class,
            'redirect.not.subscribed'=>RedirectIfNotSubscribe::class,
            'redirect.not.prenium'=>RedirectIfNotPremium::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
