<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpFoundation\Response;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */


    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenBlacklistedException) {
            return response(['error' => 'Token can not be used, get new one'], Response::HTTP_BAD_REQUEST);
        } else if ($exception instanceof TokenInvalidException) {
            return response(['error' => 'Token is invalid'], Response::HTTP_BAD_REQUEST);
        } else if ($exception instanceof TokenExpiredException) {
            return response(['error' => 'Token is Expired'], Response::HTTP_BAD_REQUEST);
        } else if ($exception instanceof JWTException) {
            return response(['error' => 'Token is not provide'], Response::HTTP_BAD_REQUEST);

        }
        return parent::render($request, $exception);
    }
}
