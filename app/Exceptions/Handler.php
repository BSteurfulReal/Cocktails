<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $throwable): void
    {
        parent::report($throwable);
    }

    /**
     * @param Request $request
     * @param Throwable $throwable
     * @return Response
     * @throws Throwable
     */
    public function render($request, Throwable $throwable): Response
    {
        return parent::render($request, $throwable);
    }
}
