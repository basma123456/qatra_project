<?php

use App\Http\Controllers\Driver\AuthenticationController;
use App\Http\Controllers\Driver\DriverHomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Driver Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as' => 'drivers.', 'prefix' => 'drivers'], function () {
    
    Route::group(['middleware' => 'RedirectDriverDashboard'], function () {
        Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
        Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');
    });

    Route::group(['middleware' => ['CheckDriverAuth']], function () {
        Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::get('/', [DriverHomeController::class, 'index'])->name('home');

        Route::group(['as' => 'delivery.', 'prefix' => 'delivery'], function () {
            Route::get('/', [DriverHomeController::class, 'delivery'])->name('index');
            Route::get('/position/{lat}/{long}', [DriverHomeController::class, 'position'])->name('position');
            Route::POST('/update', [DriverHomeController::class, 'update'])->name('update');
            
        });

        Route::name('mosque.')->prefix('mosque')->group(function () {
            Route::any('/', [DriverHomeController::class, 'mosque'])->name('index');
        });
    });
});






