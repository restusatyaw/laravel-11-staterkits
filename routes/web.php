<?php

use App\Http\Controllers\Backoffice\CustomerController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\DonationTypeController;
use App\Http\Controllers\Backoffice\LoginController;
use App\Http\Controllers\Backoffice\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.index');
});


Route::prefix('auth')->name('auth.')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('index');
        Route::get('/forgot', 'forgot')->name('forgot');
        Route::post('/forgot/post', 'forgotPassword')->name('reset.password');
        Route::post('/logout', 'logout')->name('logout');
        Route::post('/store', 'login')->name('login');
    });
});

Route::prefix('1secure')->middleware(['auth:web'])->name('backoffice.')->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(CustomerController::class)->prefix('customer')->name('customer.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::post('/store', 'store')->name('store');
        Route::delete('/{id}/delete', 'destroy')->name('destroy');
        Route::get('/get-data', 'getDatatable')->name('getdata');
    });

    

    Route::prefix('master-data')->group(function () {
        Route::controller(DonationTypeController::class)->prefix('donationtype')->name('donationtype.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/update', 'update')->name('update');
            Route::post('/store', 'store')->name('store');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
            Route::get('/get-data', 'getDatatable')->name('getdata');
        });
        Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}/update', 'update')->name('update');
            Route::post('/store', 'store')->name('store');
            Route::delete('/{id}/delete', 'destroy')->name('destroy');
            Route::get('/get-data', 'getDatatable')->name('getdata');
        });
    });
});


