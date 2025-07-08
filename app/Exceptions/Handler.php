<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException as SpatieUnauthorizedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated. Please log in to access this resource.'], 401);
        }

        return redirect()->guest(route('login'));
    }

    public function render($request, Throwable $exception)
    {
        if (
            $exception instanceof SpatieUnauthorizedException ||
            $exception instanceof AuthorizationException ||
            $exception instanceof AccessDeniedHttpException
        ) {
            return response()->json([
                'status'  => 'error',
                'message' => 'User does not have the right permissions.'
            ], 403);
        }

        return parent::render($request, $exception);
    }
}
