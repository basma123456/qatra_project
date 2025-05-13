<?php

//use App\Http\Controllers\Marketing\Marketer\CouponController;
use App\Http\Controllers\Marketing\Marketer\MyAccountController;
use App\Http\Controllers\Marketing\Marketer\ResetPasswordController;
//use App\Http\Controllers\Marketing\Marketer\ShowMarketersController;
use App\Http\Controllers\Marketing\MarketerloginController;
use Illuminate\Support\Facades\Route;


Route::get('login', [MarketerLoginController::class, 'showLoginForm'])->middleware('guest:marketer');
Route::post('login', [MarketerLoginController::class, 'login'])->name('login');
Route::get('dashboard', [MarketerLoginController::class, 'dashboard'])->middleware('auth:marketer');


Route::get('reset_password', [ResetPasswordController::class, 'showResetPasswordPage'])->name('reset_password_show_email_page');
Route::post('reset_password_store', [ResetPasswordController::class, 'showResetPasswordPageStore'])->name('reset_password_show_email_page_store');
Route::post('reset_password_recieve', [ResetPasswordController::class, 'showResetPasswordReceiveCode'])->name('reset_password_receive_code');


Route::post('enter_new_password', [ResetPasswordController::class, 'enterNewPassword'])->name('reset_password.store');
Route::get('logout', function () {
    \Illuminate\Support\Facades\Auth::guard('marketer')->logout();
    return redirect()->route('marketer.login');
});


Route::get('my-account', [MyAccountController::class, 'showMyAccount'])->middleware('auth:marketer');
Route::put('update-account', [MyAccountController::class, 'updateMarketer'])->name('my_account.update')->middleware('auth:marketer');




Route::get('orders' , [\App\Http\Controllers\Marketing\Marketer\OrderController::class , 'index'])->name('orders.index');
Route::get('orders/{id}' , [\App\Http\Controllers\Marketing\Marketer\OrderController::class , 'show'])->name('orders.show');
Route::get('test' , [\App\Http\Controllers\Marketing\Marketer\OrderController::class , 'test']);

//Route::get('orders_old' , [\App\Http\Controllers\Marketing\Marketer\OrderController::class , 'index_old'])->name('orders.index.old');






/*****************/

