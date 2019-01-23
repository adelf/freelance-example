<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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

    public function report(Exception $exception)
    {
        if($exception instanceof BusinessException) return;

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ServiceException)
        {
            return response()->json([
                'error' => $exception->getUserMessage(),
            ], 422);
        }

        if($exception instanceof BusinessException)
        {
            return response()->json([
                'error' => $exception->getUserMessage(),
            ], 422);
        }

        if($exception instanceof EntityNotFoundException)
        {
            return response('', 404);
        }

        return parent::render($request, $exception);
    }
}
