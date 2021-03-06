<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
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

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
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
        if ($exception instanceof SeasonException) {
            return response()->view('errors.custom', ['message' => $exception->getMessage()]);
        } elseif ($exception instanceof \ErrorException && $exception->getPrevious() instanceof SeasonException) {
            return response()->view('errors.custom', ['message' => $exception->getPrevious()->getMessage()]);
        } elseif ($exception instanceof GameException) {
            return response()->view('errors.custom', ['message' => $exception->getMessage()]);
        } elseif ($exception instanceof \ErrorException && $exception->getPrevious() instanceof GameException) {
            return response()->view('errors.custom', ['message' => $exception->getPrevious()->getMessage()]);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->ajax()) {
            return response()->json([
                'error' => __('middleware.auth.errors.general')
            ], 401);
        }

        flash()->warning(__('middleware.auth.errors.general'))->important();
        return redirect()->guest(route('login'));
    }
}
