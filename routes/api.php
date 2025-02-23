<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\JwtMiddleware;

Route::prefix('v1')->group(function () {
    Route::controller(CustomerController::class)->prefix('auth')->group(function(){
        Route::post('/login','login');
        Route::post('/register','register');
    });

    Route::middleware(JwtMiddleware::class)->group(function () {
        Route::controller(CustomerController::class)->prefix('auth')->group(function(){
            Route::get('/me','getUser');
            Route::post('/logout','logout');
        });
        Route::controller(TransactionController::class)->prefix('transaction')->group(function(){
            Route::post('/store','store');
            Route::put('/{id}/update-payment-status','updatePaymentStatus');
        });
    });
});