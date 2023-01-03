<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

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


        if ($exception instanceof TokenMismatchException)
        {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors('token_error');
            }
        else if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException)
        {
            return redirect()
                ->back()
                ->withInput($request->input())
                ->withErrors('max_upload');
        }

        // in this case we have incorrect input data
        if ($exception->getMessage() === 'The given data was invalid.')
        {
            if (strlen($request->text) > \App\Http\Requests\PostStoreRequest::PARAMS['textMaxSize'])
            {
                return redirect()
                    ->back()
                    ->withInput($request->input())
                    ->withErrors('text_too_big');
            }
        }

        //dd($request, $request->text, $exception->getCode(), $exception->getLine(), $exception->getMessage());
        return parent::render($request, $exception);
    }
}
