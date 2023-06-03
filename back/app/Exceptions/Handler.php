<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
        $this->reportable(function (NotFoundHatProductException $e) {
            return abort(404, 'notFoundHatProduct');
        });

        $this->reportable(function (NotEnoughCandiesException $e) {
            return abort(400, 'notEnoughCandies');
        });

        $this->reportable(function (NotFoundBalanceException $e) {
            return abort(404, 'notFoundBalance');
        });

        $this->reportable(function (NotPositiveCountException $e) {
            return abort(404, 'notPositiveCount');
        });
    }
}