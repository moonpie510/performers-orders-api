<?php

use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\WorkerController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::controller(UserController::class)->prefix('user')->group(function () {
            Route::post('/login', 'login')->middleware(['guest', 'throttle:60']);
            Route::post('/register', 'register');
            Route::post('/logout', 'logout')->middleware('auth:api');
            Route::get('/sessions', 'index')->middleware('auth:api');
            Route::delete('/sessions/{id}', 'delete')->middleware('auth:api');
        });
    });

    Route::controller(OrderController::class)->prefix('orders')->middleware('auth:api')->group(function () {
        Route::post('/', 'store');
        Route::put('/{order}/status', 'updateStatus');
        Route::post('/assign-worker', 'assignWorker');
    });

    Route::controller(WorkerController::class)->prefix('workers')->group(function () {
        Route::get('/', 'index');
        Route::post('/{id}/login', 'login');
    });
});


Require __DIR__ . '/passport.php';
