<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\{AuthController, PasswordController};

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

Route::domain(env('API_URL'))->group(function() {
    Route::post('/signup', [AuthController::class, 'signup'])->name('api.signup');
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/password/reset', [PasswordController::class, 'reset'])->name('api.password.reset');
    Route::post('/reset/process', [PasswordController::class, 'process'])->name('api.reset.process');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::prefix('credit')->group(function () {
            Route::post('/buy', [WalletController::class, 'buy'])->name('user.credit.buy');
        });
    });
});
