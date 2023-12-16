<?php

use App\Http\Controllers\Api\V1\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\V1\Auth\NewPasswordController;
use App\Http\Controllers\Api\V1\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\V1\Auth\RegisteredUserController;
use App\Http\Controllers\Api\v1\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Api\V1\Auth\VerifyEmailController;
use App\Http\Controllers\TestContentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/v1/authentication/')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::post('/login', [AuthenticatedSessionController::class, 'login']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->middleware('auth:api');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('auth:api');
    Route::get('email/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['auth:api', 'throttle:6,1']);
    Route::post('password/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest');
    Route::post('password/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest');
});


Route::prefix('/v1/test')->middleware(['auth:api', 'verified'])->group(function () {
    Route::get('/', [TestContentController::class, 'index']);
    Route::post('/', [TestContentController::class, 'store']);
});
