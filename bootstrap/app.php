<?php

use App\Exceptions\ErrorHandler;
use App\Http\Middleware\EnsureKeepExam;
use App\Http\Middleware\EnsurePreExam;
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
        $middleware->alias([
            'EnsurePreExam' =>EnsurePreExam::class,
            'EnsureKeepExam' =>EnsureKeepExam::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Daftarkan custom error handler Anda
        $exceptions->render(function (Throwable $e) {
            $handler = new ErrorHandler();
            return $handler->render($e);
        });
    })->create();
