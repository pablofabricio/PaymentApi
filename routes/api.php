<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Payment
    Route::get('payments', [PaymentController::class, 'all']);
    Route::get('payments/{id}', [PaymentController::class, 'find']);
    Route::delete('payments/{id}', [PaymentController::class, 'destroy']);
    Route::patch('payments/{id}', [PaymentController::class, 'confirmPayment']);
    Route::post('payments', [PaymentController::class, 'create']);
