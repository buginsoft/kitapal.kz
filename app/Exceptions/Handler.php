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

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        $code = -1;
        $exclude_messages = [
            "Unauthenticated" ,"'book_name' of non-object" , "invalid",'denied '
        ];

        $message = $exception->getMessage();
        $excepted = true;
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface) {
            $code = $exception->getStatusCode();
        }
        foreach ($exclude_messages as $_message) {
            if (mb_stripos($message, $_message) !== false) {
                $excepted = false;
                break;
            }
        }
       // $url = $_SERVER['REQUEST_URI'];

        /*if ($excepted && !in_array($code, [404])) {
            \TLE::exp($exception)->send($url);
        }*/

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        return parent::render($request, $e);
    }
}
