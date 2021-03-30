<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                        'exception' => 'ModelNotFoundException',
                        'message' => 'Nodo no encontrado id: '. implode(', ', $exception->getIds()),
                        'code' => 404
                ]
                )->setStatusCode(404);
            }
            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                        'exception' => 'NotFoundHttpException',
                        'message' => "Ruta no encontrada",
                        'code' => 404
                    ]
                )->setStatusCode(404);
            }

            if ($exception instanceof ThrottleRequestsException) {
                return response()->json([
                    'exception' => 'ThrottleRequestsException',
                    'message' => $exception->getMessage(),
                    'code' => 429
                ])->setStatusCode(429);
            }

            if ($exception instanceof ParentException)  {
                return response()->json([
                    'exception' => 'ParentException',
                    'message' => 'No hay un padre',
                    'code' => 200
                ])->setStatusCode(200);
            }

            if ($exception instanceof ChildException)  {
                return response()->json([
                    'exception' => 'ChildException',
                    'message' => 'No hay hijos',
                    'code' => 200
                ])->setStatusCode(200);
            }

        }

        return parent::render($request, $exception);
    }

}
