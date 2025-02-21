<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.token' => CheckToken::class,
        ]);

        // 配置 CSRF 例外路由
        $middleware->validateCsrfTokens(
            except: ['api/*', 'login']
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {})->create();
