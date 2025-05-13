<?php

use App\Http\Controllers\Marketing\MarketerAdmin\CouponController;
use App\Http\Controllers\Marketing\MarketerAdmin\MyAccountController;
use App\Http\Controllers\Marketing\MarketerAdmin\ResetPasswordController;
use App\Http\Controllers\Marketing\MarketerAdmin\ShowMarketersController;
use App\Http\Controllers\Marketing\MarketerAdminloginController;
use Illuminate\Support\Facades\Route;


Route::get('login', [MarketerAdminLoginController::class, 'showLoginForm'])->middleware('guest:marketer_admin');
Route::post('login', [MarketerAdminLoginController::class, 'login'])->name('login');
Route::middleware('marketer_admin_middleware')->group(function () {
    Route::get('dashboard', [MarketerAdminLoginController::class, 'dashboard']);
});

Route::get('marketers', [ShowMarketersController::class, 'showMarketers'])->name('show_my_marketers');
/*******************/
//    Route::get('marketers-coupon/{marketer_id}', [ShowMarketersController::class, 'showMarketers'])->name('coupon.create');
Route::get('marketers-edit/{marketer_id}', [ShowMarketersController::class, 'editMarketer'])->name('marketer.edit');
Route::get('marketers-create', [ShowMarketersController::class, 'createMarketer'])->name('marketer.create');
Route::post('marketers-store', [ShowMarketersController::class, 'storeMarketer'])->name('marketer.store');
Route::get('marketers-show/{marketer_id}', [ShowMarketersController::class, 'showMarketer'])->name('marketer.show');
Route::delete('marketer-delete/{marketer_id}', [ShowMarketersController::class, 'deleteMarketer'])->name('marketer.delete');
Route::get('marketers-edit/{marketer_id}', [ShowMarketersController::class, 'editMarketer'])->name('marketer.edit');
Route::put('marketers-update/{marketer_id}', [ShowMarketersController::class, 'updateMarketer'])->name('marketer.update');
Route::delete('marketers-delete/{marketer_id}', [ShowMarketersController::class, 'destroyMarketer'])->name('marketer.delete');

Route::name('coupon.')->prefix('coupon')->group(function () {
    Route::get('/', [CouponController::class, 'index'])->name('index');
    Route::get('/create/{marketer}', [CouponController::class, 'create'])->name('create');
    Route::post('/create', [CouponController::class, 'store'])->name('store');
    Route::get('/edit/{coupon}', [CouponController::class, 'edit'])->name('edit');
    Route::post('/edit/{coupon}', [CouponController::class, 'update'])->name('update');
    Route::get('/activate/{coupon}', [CouponController::class, 'activate'])->name('activate');
    Route::get('/deactivate/{coupon}', [CouponController::class, 'deactivate'])->name('deactivate');
    Route::delete('/delete/{coupon}', [CouponController::class, 'destroy'])->name('delete');
});


//Route::get('email',
//    function () {
//        $code = rand(10 , 999999);  // Example data to pass to the email
//
//        // Send the email to the recipient
//        \Illuminate\Support\Facades\Mail::to( "basma.gamaleldin100@gmail.com")->send(new \App\Mail\MarketerAdminResetPasswordMailable($code));
//
//        dd( 'Email sent!');
//    });

Route::get('reset_password', [ResetPasswordController::class , 'showResetPasswordPage'])->name('reset_password_show_email_page');
Route::post('reset_password_store', [ResetPasswordController::class , 'showResetPasswordPageStore'])->name('reset_password_show_email_page_store');
Route::post('reset_password_recieve', [ResetPasswordController::class , 'showResetPasswordReceiveCode'])->name('reset_password_receive_code');


Route::post('enter_new_password', [ResetPasswordController::class , 'enterNewPassword'])->name('reset_password.store');
Route::get('logout' , function (){
    \Illuminate\Support\Facades\Auth::guard('marketer_admin')->logout();
    return redirect()->route('marketer_admin.login');
});



Route::get('my-account', [MyAccountController::class , 'showMyAccount'])->middleware('auth:marketer_admin');
Route::put('update-account', [MyAccountController::class , 'updateMarketerAdmin'])->name('my_account.update')->middleware('auth:marketer_admin');
Route::get('orders' , [\App\Http\Controllers\Marketing\MarketerAdmin\OrderController::class , 'index'])->name('orders.index');





/*****************/

