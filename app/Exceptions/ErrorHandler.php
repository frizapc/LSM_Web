<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class ErrorHandler
{
    public function render(Throwable $exception, ?string $message = null)
    {
        if (request()->expectsJson()) {
            return $this->handleJsonError($exception, $message);
        }

        return $this->handleViewError($exception, $message);
    }

    protected function handleJsonError(Throwable $e, ?string $message = null)
    {
        $status = $this->resolveStatusCode($e);

        return response()->json([
            'success' => false,
            'message' => $message ?: $this->defaultMessage($status),
            'status'  => $status,
        ], $status);
    }

    protected function handleViewError(Throwable $e, ?string $message = null)
    {
        $status = $this->resolveStatusCode($e);

        $title = $this->defaultMessage($status);

        // Selalu gunakan 1 file error view kustom
        return response()->view('errors.custom', [
            'title'   => $title,
            'code'    => $status,
            'message' => $message ?: $this->defaultMessage($status),
        ], $status);
    }

    /**
     * Tentukan status code berdasarkan tipe exception
     */
    protected function resolveStatusCode(Throwable $e): int
    {
        if ($e instanceof HttpExceptionInterface) {
            return $e->getStatusCode();
        }

        if ($e instanceof ModelNotFoundException) {
            return 404;
        }

        if ($e instanceof AuthenticationException) {
            return 401;
        }

        return 500; // default
    }

    /**
     * Pesan bawaan bila exception tidak memiliki message
     */
    protected function defaultMessage(int $status): string
    {
        return match ($status) {
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Page not found',
            419 => 'Page expired',
            422 => 'Unprocessable Entity',
            500 => 'Internal Server Error',
            default => 'Unexpected Error',
        };
    }
}
