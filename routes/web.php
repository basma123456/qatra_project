<?php


use App\Http\Controllers\Client\CartControler;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PagesController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\Profile\AuthController;
use App\Http\Controllers\Client\Profile\ProfileController;
use App\Http\Controllers\Marketing\MarketerAdmin\ShowMarketersController;
use App\Http\Controllers\Marketing\MarketerloginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::view('test', 'test.test');


Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('products', [ProductController::class, 'index'])->name('client.products');
Route::get('products/{slug}', [ProductController::class, 'show'])->name('client.products.show');

Route::get('add-to-cart', [CartControler::class, 'index'])->name('client.cart.index');
Route::post('cart', [CartControler::class, 'store'])->name('client.cart.store');

Route::get('pages/{slug}', [PagesController::class, 'show'])->name('client.pages.show');


Route::get('checkout', [CheckoutController::class, 'index'])->name('client.checkout.index');
Route::post('checkout', [CheckoutController::class, 'index'])->name('client.checkout.submit');
Route::get('checkout/success', [CheckoutController::class, 'success'])->name('client.checkout.success');
Route::any('/payment/result/{order_id}', [App\Http\Controllers\PaymentController::class, 'result'])->name('front.payment.result')->middleware('CheckDonorAuth');
Route::any('/payment/charge/{order_id}', [App\Http\Controllers\PaymentController::class, 'charge'])->name('front.payment.charge')->middleware('CheckDonorAuth');


// Authentication Profile ----------------------------------------------------------------------
Route::group(['middleware' => ['RedirectProfile']], function () {
    Route::get('login', [AuthController::class, 'login'])->name('client.login');
    Route::get('register', [AuthController::class, 'register'])->name('client.register');
});
Route::get('logout', [AuthController::class, 'logout'])->name('client.logout');
// Profile ----------------------------------------------------------------------
Route::group(['prefix' => 'profile', 'middleware' => ['CheckDonorAuth'], 'as' => 'client.profile.'], function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
    Route::POST('update', [ProfileController::class, 'update'])->name('update');
    Route::get('orders', [ProfileController::class, 'orders'])->name('orders');
    Route::get('favorite-mosque', [ProfileController::class, 'favoriteMosque'])->name('favorite-mosque');
    Route::get('notfications', [ProfileController::class, 'notifications'])->name('notifications');
    Route::POST('notfications', [ProfileController::class, 'notificationsUpdate'])->name('notifications.update');
});

    Route::get('orders/invoices/{id}', [ProfileController::class, 'OrderInvoices'])->name('order.invoices');
    Route::get('orders/tracking/{id}', [ProfileController::class, 'OrderTracking'])->name('order.tracking');

Route::prefix('marketer')->group(function () {
    Route::get('login', [MarketerloginController::class, 'showLoginForm']);
    Route::post('login', [MarketerloginController::class, 'login'])->name('marketer.login');
    Route::middleware('marketer_middleware')->group(function () {
        Route::get('dashboard', [MarketerloginController::class, 'dashboard']);
    });
});


Route::name('front.')->group(function () {
    Route::any('/affiliate/{code}', [App\Http\Controllers\AffiliateController::class, 'index'])->name('affiliate');
    Route::any('/affiliate/browse/{code}', [App\Http\Controllers\AffiliateController::class, 'browse'])->name('affiliate.browse');
    Route::any('/coupon/add', [App\Http\Controllers\PaymentController::class, 'coupon'])->name('coupon.add');
    Route::get('/12', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('trackVisitor');
    Route::any('/mosques', [App\Http\Controllers\MosqueController::class, 'index'])->name('mosques')->middleware('trackVisitor'); //->middleware("auth", "data_entry");
});


Route::any('public/pdf/{code}.pdf', [App\Http\Controllers\OrderController::class, 'pdf2'])->name('orders.public.pdf');



//Route::prefix('marketer_admin')->group(function () {
//    Route::get('login', [MarketerAdminLoginController::class, 'showLoginForm']);
//    Route::post('login', [MarketerAdminLoginController::class, 'login'])->name('marketer_admin.login');
//    Route::middleware('marketer_admin_middleware')->group(function () {
//        Route::get('dashboard', [MarketerAdminLoginController::class, 'dashboard']);
//    });
//
//    Route::get('marketers', [ShowMarketersController::class, 'showMarketers'])->name('marketer_admin.show_my_marketers');
//    /*******************/
////    Route::get('marketers-coupon/{marketer_id}', [ShowMarketersController::class, 'showMarketers'])->name('coupon.create');
//    Route::get('marketers-edit/{marketer_id}', [ShowMarketersController::class, 'editMarketer'])->name('marketer.edit');
//    Route::get('marketers-show/{marketer_id}', [ShowMarketersController::class, 'editMarketer'])->name('marketer.show');
//    Route::delete('marketer-delete/{marketer_id}', [ShowMarketersController::class, 'deleteMarketer'])->name('marketer.delete');
//
//
//
//
//
//    /*****************/
//});
//
//



//Route::get('/user/register', [App\Http\Controllers\UserController::class, 'register'])->name('register')->middleware('guest');;
//Route::post('/user/register', [App\Http\Controllers\UserController::class, 'register_post'])->middleware('guest');;
//Route::get('/user/login', [App\Http\Controllers\UserController::class, 'login'])->name('login')->middleware('guest');;
//Route::post('/user/login', [App\Http\Controllers\UserController::class, 'login_post'])->middleware('guest');;
//Route::get('/user/resend/otp', [App\Http\Controllers\UserController::class, 'resend_otp'])->name('resend.otp');
//Route::get('/user/otp', [App\Http\Controllers\UserController::class, 'otp'])->name('otp');
//Route::post('/user/otp', [App\Http\Controllers\UserController::class, 'otp_post']);
//Route::get('/user/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout')->middleware('auth');
//Route::get('/user/account', [App\Http\Controllers\UserController::class, 'account'])->name('user.account')->middleware('auth');
//Route::get('/user/favorites', [App\Http\Controllers\UserController::class, 'favorites'])->name('user.favorites')->middleware('auth');
//Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile')->middleware('auth');
//Route::post('/user/profile', [App\Http\Controllers\UserController::class, 'profile_post'])->middleware('auth');
//Route::post('/user/password', [App\Http\Controllers\UserController::class, 'password_post'])->middleware('auth')->name("user.password");






