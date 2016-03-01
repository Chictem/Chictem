<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }
        $space = $this->getViewSpace($request);

        $status = $e->getStatusCode();

        if (view()->exists($space . '.errors.' . $status)) {
            return response()->view($space . '.errors.' . $status, compact('e'), $status);
        }

        return parent::render($request, $e);
    }

    public function getViewSpace($request)
    {
        $spaces = ['manage', 'front'];
        $uri = $request->getRequestUri();
        if (strpos($uri, $spaces[0]) !== false) {
            return $spaces[0];
        } else {
            return $spaces[1];
        }
    }

}
