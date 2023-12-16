<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Error;
use ErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use LogicException;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return $this->errorResponse($e->getMessage(), 404);
        });
        $this->renderable(function (LogicException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        });
        $this->renderable(function (ErrorException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        });
        $this->renderable(function (RuntimeException $e) {
            return $this->errorResponse($e->getMessage(), 500);
        });
        $this->renderable(function (Error $e) {
            return $this->errorResponse($e->getMessage(), 500);
        });
    }
}
