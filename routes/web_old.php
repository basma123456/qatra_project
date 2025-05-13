<?php

use App\Helpers\GiftCard;
use App\Helpers\Msegat;
use App\Helpers\Taqnyat;
use App\Http\Controllers\Client\HomeController;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

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

Route::get('/home', function () {
    return redirect()->route("front.home");
});

Route::get('/p', function () {
    return redirect()->route('front.affiliate', 'rohvscwiuh5d');
});


// Auth::routes();

Route::get('/account', [App\Http\Controllers\HomeController::class, 'account'])->name('account');
Route::get('/notification', [App\Http\Controllers\HomeController::class, 'notification'])->name('notification');
Route::get('/order-history', [App\Http\Controllers\HomeController::class, 'order_history'])->name('order-history');

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about')
    ->middleware('trackVisitor');
Route::get('/aboutus', [App\Http\Controllers\HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/contactus', [App\Http\Controllers\HomeController::class, 'contactus'])->name('contactus')->middleware('trackVisitor');
Route::post('/contactus', [App\Http\Controllers\HomeController::class, 'contactus_submit']);
Route::get('/terms', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms')->middleware('trackVisitor');
Route::get('/policy', [App\Http\Controllers\HomeController::class, 'policy'])->name('policy')->middleware('trackVisitor');
Route::get('/lang', [App\Http\Controllers\HomeController::class, 'lang'])->name('lang')->middleware('trackVisitor');

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'do_login']);
});

Route::get('/login', function () {
    return redirect()->route("login");
});
Route::get('/wishlist', function () {
    return redirect()->route("front.home");
})->name("wishlist");
Route::get('/register', function () {
    return redirect()->route("register");
});


Route::get('/user/register', [App\Http\Controllers\UserController::class, 'register'])->name('register')->middleware('guest');;
Route::post('/user/register', [App\Http\Controllers\UserController::class, 'register_post'])->middleware('guest');;
Route::get('/user/login', [App\Http\Controllers\UserController::class, 'login'])->name('login')->middleware('guest');;
Route::post('/user/login', [App\Http\Controllers\UserController::class, 'login_post'])->middleware('guest');;
Route::get('/user/resend/otp', [App\Http\Controllers\UserController::class, 'resend_otp'])->name('resend.otp');
Route::get('/user/otp', [App\Http\Controllers\UserController::class, 'otp'])->name('otp');
Route::post('/user/otp', [App\Http\Controllers\UserController::class, 'otp_post']);
Route::get('/user/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/user/account', [App\Http\Controllers\UserController::class, 'account'])->name('user.account')->middleware('auth');
Route::get('/user/favorites', [App\Http\Controllers\UserController::class, 'favorites'])->name('user.favorites')->middleware('auth');
Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('/user/profile', [App\Http\Controllers\UserController::class, 'profile_post'])->middleware('auth');
Route::post('/user/password', [App\Http\Controllers\UserController::class, 'password_post'])->middleware('auth')->name("user.password");
// });

Route::get('/mosques/favorites/add/{mosque}', [App\Http\Controllers\MosqueController::class, 'add_favorite'])->name('favorite.add')->middleware("auth");
Route::get('/mosques/favorites/remove/{mosque}', [App\Http\Controllers\MosqueController::class, 'remove_favorite'])->name('favorite.remove')->middleware("auth");
Route::name('front.')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('trackVisitor');
    Route::any('/mosques', [App\Http\Controllers\MosqueController::class, 'index'])->name('mosques')->middleware('trackVisitor'); //->middleware("auth", "data_entry");
    Route::any('/mosques/search/{text}', [App\Http\Controllers\MosqueController::class, 'search'])->name('mosques.search'); //->middleware("auth", "data_entry");
    Route::get('/mosques/json/{district?}', [App\Http\Controllers\MosqueController::class, 'json'])->name('mosques.json');
    Route::get('/mosques/image/{image}', [App\Http\Controllers\MosqueController::class, 'image'])->name('mosque.item.image'); //->middleware(["auth"]);
    Route::get('/mosques/item/json/{cid}', [App\Http\Controllers\MosqueController::class, 'json_item'])->name('mosque.item.json')->middleware(['throttle:global']);
    Route::get('/mosques/img/{img}', [App\Http\Controllers\MosqueController::class, 'img'])->name('mosque.item.img')->middleware(["auth"]);
    Route::get('/products/anymosque', [App\Http\Controllers\ProductController::class, 'anymosque'])->name('products.anymosque'); //->middleware('auth', 'data_entry');;
    Route::get('/products/{mosque}', [App\Http\Controllers\ProductController::class, 'index'])->name('products'); //->middleware('auth', 'data_entry');;

    Route::any('/payment/do/{order_id}', [App\Http\Controllers\PaymentController::class, 'do'])->name('payment.do')->middleware('auth');
    Route::get('/payment/abandon/{order}', [App\Http\Controllers\PaymentController::class, 'abandon'])->name('payment.abandon')->middleware('auth');;
    Route::get('/payment/show/{order}', [App\Http\Controllers\PaymentController::class, 'show'])->name('payment.show')->middleware('auth');;
    Route::any('/payment/applepay/{order_id}', [App\Http\Controllers\PaymentController::class, 'applepay'])->name('payment.applepay')->middleware('auth');;
    Route::any('/payment/check/{order_id}', [App\Http\Controllers\PaymentController::class, 'check'])->name('payment.check');
    Route::any('/payment/charge/{order_id}', [App\Http\Controllers\PaymentController::class, 'charge'])->name('payment.charge')->middleware('auth');;
    Route::any('/payment/result/{order_id}', [App\Http\Controllers\PaymentController::class, 'result'])->name('payment.result')->middleware('auth');;
    Route::any('/payment/transfer/{order_id}', [App\Http\Controllers\PaymentController::class, 'transfer'])->name('payment.transfer')->middleware('auth');;
    Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment')->middleware('trackVisitor'); //->middleware('auth');;
    Route::any('/orders/pdf/{order}', [App\Http\Controllers\OrderController::class, 'pdf'])->name('orders.pdf')->middleware('auth');;
    Route::any('/orders/public/pdf/{code}.pdf', [App\Http\Controllers\OrderController::class, 'pdf2'])->name('orders.public.pdf');
    Route::any('/orders/track/{order}', [App\Http\Controllers\OrderController::class, 'track'])->name('orders.track')->middleware('auth');;
    Route::any('/orders/{order}', [App\Http\Controllers\OrderController::class, 'item'])->name('orders.item')->middleware('auth');;
    Route::any('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders')->middleware('auth', 'data_entry');;

    Route::any('/affiliate/{code}', [App\Http\Controllers\AffiliateController::class, 'index'])->name('affiliate');
    Route::any('/affiliate/browse/{code}', [App\Http\Controllers\AffiliateController::class, 'browse'])->name('affiliate.browse');
    Route::any('/coupon/add', [App\Http\Controllers\PaymentController::class, 'coupon'])->name('coupon.add');
});


Route::get("ab", function () {
    Artisan::call("abandon:send");
});




//Route::get('/' , [HomeController::class , 'index']);
