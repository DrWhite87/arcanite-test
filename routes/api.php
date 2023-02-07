<?php

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


Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('register');
Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum', 'ability:local'])->group(function () {
    Route::post('logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout');
    Route::post('token', [\App\Http\Controllers\Api\AuthController::class, 'token'])->name('token');

    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => \App\Data\UserData::from($request->user()),
            'message' => '',
        ], 200);
    });

    Route::resource('payments', \App\Http\Controllers\Api\PaymentController::class);//->only(['index', 'show']);

    Route::patch('/payments/{payment}/updateStatus', [\App\Http\Controllers\Api\PaymentController::class, 'updateStatus'])
        ->name('payments.updateStatus')->where(['payment' => '[0-9]+']);
});

Route::middleware(['auth:sanctum', 'ability:global'])->group(function () {
    Route::post('/payments', [\App\Http\Controllers\Api\PaymentController::class, 'store'])
        ->name('payments.apiStore')->where(['payment' => '[0-9]+']);
});
