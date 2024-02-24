<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth-jwt')->name('auth.jwt');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

// Payment
    Route::get('payments', [PaymentController::class, 'all']);
    Route::get('payments/{id}', [PaymentController::class, 'find']);
    Route::delete('payments/{id}', [PaymentController::class, 'destroy']);
    Route::patch('payments/{id}', [PaymentController::class, 'confirmPayment']);
    Route::post('payments', [PaymentController::class, 'create']);
