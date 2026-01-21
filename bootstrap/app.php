<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withProviders([
        \App\Providers\EventServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'verify.fedresurs.api.key' => \App\Http\Middleware\VerifyFedresursIncomingApiKey::class,
            'verify.external.service.api.key' => \App\Http\Middleware\VerifyExternalServiceApiKey::class,
            'verify.debtor.updater.api.key' => \App\Http\Middleware\VerifyDebtorUpdaterApiKey::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
