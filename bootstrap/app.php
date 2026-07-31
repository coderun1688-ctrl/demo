<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(\ErlandMuchasaj\LaravelGzip\Middleware\GzipEncodeResponse::class);

        //後台中介層驗證
        $middleware->alias([
            'GlobalMiddleware'    => \App\Http\Middleware\GlobalMiddleware::class,
            'WebSetting'    => \App\Http\Middleware\WebSetting::class,
            'MemberGuest'  => \App\Http\Middleware\MemberGuest::class,
            'MemberAuth'   => \App\Http\Middleware\MemberAuth::class,
            'guest' => \App\Http\Middleware\AdminGMiddleware::class,
            'admin' => \App\Http\Middleware\AdminCheckMiddleware::class,
        ]);

        //CSRF 保護中排除 URI
        $middleware->preventRequestForgery(except: [
            'stripe/*',
            'http://example.com/foo/bar',
            'http://example.com/foo/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
