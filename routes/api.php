<?php

use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::controller(UserController::class)->prefix('user')->group(function () {
            Route::post('/login', 'login')->middleware(['guest', 'throttle:60']);
            Route::post('/register', 'register')->middleware(['guest', 'throttle:60']);
            Route::post('/logout', 'logout')->middleware('auth:api');
            Route::get('/sessions', 'index')->middleware('auth:api');
            Route::delete('/sessions/{id}', 'delete')->middleware('auth:api');
        });
    });
});


Require __DIR__ . '/passport.php';
