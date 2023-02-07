<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
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

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'status' => false,
            'statusCode' => Response::HTTP_UNAUTHORIZED,
            'message' => 'Unauthenticated.',
            'result' => (object)[],
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'statusCode' => Response::HTTP_NOT_FOUND,
                'message' => 'Not Found.',
            ], Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof TokenMismatchException) {
            return response()->json([
                'success' => false,
                'statusCode' => Response::HTTP_UNAUTHORIZED,
                'message' => 'Unauthenticated. TokenMismatchException',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'The given data was invalid.',
                'errors' => $exception->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if($exception instanceof MissingAbilityException){
            return response()->json([
                'success' => false,
                'statusCode' => Response::HTTP_FORBIDDEN,
                'message' => 'Forbidden.',
            ], Response::HTTP_FORBIDDEN);
        }

        return parent::render($request, $exception);
    }
}
