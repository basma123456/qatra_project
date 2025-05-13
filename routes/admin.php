<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\Authorizations\RolesController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\MenueController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadeImageTexteditor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


// admin.mosque2.boundaries



Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {


    Route::group(['middleware' => 'RedirectDashboard'], function () {
        Route::get('/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
        Route::post('/login', [App\Http\Controllers\Admin\AuthController::class, 'postLogin'])->name('postLogin');
    });


    Route::group(['middleware' => ['CheckAdminAuth']], function () {

        Route::get('/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

        Route::group(['middleware' => 'CheckPermissionRoute'], function () {

            Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

            // ----- Admins -----------------------------------------------
            Route::resource('admin', AdminsController::class);
            Route::post('admin/actions', [AdminsController::class, 'actions'])->name('admin.actions');
            Route::get('admin/update-status/{id}', [AdminsController::class, 'update_status'])->name('admin.update-status');
            //--------------- End Admins ----------//

            // ----- Authorization -----------------------------------------------
            Route::resource('roles', RolesController::class);


            Route::get('/settings', [App\Http\Controllers\Admin\HomeController::class, 'settings'])->name('settings');

            Route::name('reports.')->prefix('reports')->group(function () {
                Route::get('/cities', [ReportController::class, 'cities'])->name('cities');
                Route::get('/products', [ReportController::class, 'products'])->name('products');
                Route::get('/visitors', [ReportController::class, 'visitors'])->name('visitors');
            });

            Route::name('mosque.')->prefix('mosque')->group(function () {
                Route::any('/', [App\Http\Controllers\Admin\MosqueController::class, 'index'])->name('index');
                Route::get('/create', [App\Http\Controllers\Admin\MosqueController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\MosqueController::class, 'store'])->name('store');
                Route::get('/edit/{mosque}', [App\Http\Controllers\Admin\MosqueController::class, 'edit'])->name('edit');
                Route::get('/{mosque}', [App\Http\Controllers\Admin\MosqueController::class, 'show'])->name('show');

                Route::post('/edit/{mosque}', [App\Http\Controllers\Admin\MosqueController::class, 'update'])->name('update');
                Route::delete('/delete/{mosque}', [App\Http\Controllers\Admin\MosqueController::class, 'destroy'])->name('destroy');
                Route::post('actions', [App\Http\Controllers\Admin\MosqueController::class, 'actions'])->name('actions');
                Route::get('update-status/{id}', [App\Http\Controllers\Admin\MosqueController::class, 'update_status'])->name('update-status');
            });

            Route::name('driver.')->prefix('driver')->group(function () {
                Route::get('/', [App\Http\Controllers\Admin\DriverController::class, 'index'])->name('index');
                Route::get('/create', [App\Http\Controllers\Admin\DriverController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\DriverController::class, 'store'])->name('store');
                Route::get('/edit/{driver}', [App\Http\Controllers\Admin\DriverController::class, 'edit'])->name('edit');
                Route::post('/edit/{driver}', [App\Http\Controllers\Admin\DriverController::class, 'update'])->name('update');
                Route::get('/delete/{driver}', [App\Http\Controllers\Admin\DriverController::class, 'destroy'])->name('delete');
            });

            Route::group(['as' => 'marketer.', 'prefix' => 'marketer'], function () {
                Route::get('/', [App\Http\Controllers\Admin\MarketerController::class, 'index'])->name('index');
                Route::get('/create', [App\Http\Controllers\Admin\MarketerController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\MarketerController::class, 'store'])->name('store');
                Route::get('/edit/{marketer}', [App\Http\Controllers\Admin\MarketerController::class, 'edit'])->name('edit');
                Route::post('/edit/{marketer}', [App\Http\Controllers\Admin\MarketerController::class, 'update'])->name('update');
                Route::get('/delete/{marketer}', [App\Http\Controllers\Admin\MarketerController::class, 'destroy'])->name('delete');
                Route::get('/{id}', [App\Http\Controllers\Admin\MarketerController::class, 'show'])->name('show');
            });

            Route::group(['as' => 'marketer_admin.', 'prefix' => 'marketer_admin'], function () {
                Route::get('/', [App\Http\Controllers\Admin\MarketerAdminController::class, 'index'])->name('index');
                Route::get('/create', [App\Http\Controllers\Admin\MarketerAdminController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\MarketerAdminController::class, 'store'])->name('store');
                Route::get('/edit/{marketer_admin}', [App\Http\Controllers\Admin\MarketerAdminController::class, 'edit'])->name('edit');
                Route::put('/edit/{marketer_admin}', [App\Http\Controllers\Admin\MarketerAdminController::class, 'update'])->name('update');
                Route::get('/delete/{marketer_admin}', [App\Http\Controllers\Admin\MarketerAdminController::class, 'destroy'])->name('delete');
                Route::get('/{id}', [App\Http\Controllers\Admin\MarketerAdminController::class, 'show'])->name('show');
            });

            Route::group(['as' => 'coupon.', 'prefix' => 'coupon'], function () {
                Route::get('/', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('index');
                Route::get('/create/{marketer}', [App\Http\Controllers\Admin\CouponController::class, 'create'])->name('create');
                Route::post('/create', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('store');
                Route::get('/edit/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('edit');
                Route::post('/edit/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'update'])->name('update');
                Route::get('/activate/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'activate'])->name('activate');
                Route::get('/deactivate/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'deactivate'])->name('deactivate');
                Route::get('/delete/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('delete');
            });

            Route::group(['as' => 'delivery.', 'prefix' => 'delivery'], function () {
                Route::get('/', [App\Http\Controllers\Admin\DeliveryController::class, 'index'])->name('index');
                Route::get('/position/{lat}/{long}', [App\Http\Controllers\Admin\DeliveryController::class, 'position'])->name('position');
                Route::post('/update', [App\Http\Controllers\Admin\DeliveryController::class, 'update'])->name('update');
            });

            // Route::group(['as' => 'order.', 'prefix' => 'order'], function () {
            //     Route::controller(OrderController::class, function () {
            //         Route::any('/', 'index')->name('index');
            //         Route::post('/send-message', 'send_message')->name('send-message');
            //         Route::get('/item/{order}', 'item')->name('item');
            //         Route::post('/assign', 'set_assign')->name('assign.set');
            //         Route::get('/assign', 'assign')->name('assign');
            //         Route::get('/export', 'export')->name('export');
            //         Route::get('/assign/report', 'assign_report')->name('assign.report');
            //         Route::get('/assign/send/pdf', 'sendEmail')->name('assign.send.file');
            //         Route::get('/pdf/{order}', 'pdf')->name('pdf');
            //         Route::get('/images/{order}', 'images')->name('images');
            //         Route::get('/deleteImage/{order_image}', 'deleteImage')->name('deleteImage');
            //         Route::post('/addImage/{order}', 'addImage')->name('addImage');
            //         Route::get('/reducingSize/{id?}', 'reducingSize')->name('reducingSize');
            //     });
            // });


            // orders
            Route::group(['as' => 'orders.', 'prefix' => 'orders'], function () {
                Route::get('/', [OrdersController::class, 'index'])->name('index');
                Route::get('invoices/{id}', [OrdersController::class, 'invoices'])->name('invoices');
                Route::get('pdf/{id}', [OrdersController::class, 'downloadPdf'])->name('pdf');
                Route::POST('addImage/{order}', [OrdersController::class, 'addImage'])->name('addImage');
                Route::get('deleteImage/{order_image}', [OrdersController::class, 'deleteImage'])->name('deleteImage');
                Route::get('assign/', [OrdersController::class, 'assign'])->name('assign');
                Route::POST('assign/', [OrdersController::class, 'set_assign'])->name('assign.set');
                Route::get('assign/report', [OrdersController::class, 'assign_report'])->name('assign.report');
                Route::get('images/{order}', [OrdersController::class, 'images'])->name('images');
                Route::any('public/pdf/{code}.pdf', [OrdersController::class, 'pdf2'])->name('orders.public.pdf');

            });


            Route::name('transfer.')->prefix('transfer')->controller(App\Http\Controllers\Admin\TransferController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/item/{transfer}', 'item')->name('item');
                Route::get('/file/{transfer}', 'get_file')->name('get_file');
                Route::get('/confirm/{transfer}', 'confirm')->name('confirm');
            });
            Route::name('message.')->prefix('message')->controller(App\Http\Controllers\Admin\MessageController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/item/{message}', 'item')->name('item');
                Route::get('/confirm/{message}', 'confirm')->name('confirm');
                Route::get('/sent', 'sent')->name('sent');
            });

            Route::name('cards.')->prefix('cards')->controller(App\Http\Controllers\Admin\CardsController::class)->group(function () {
                Route::any('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/create', 'store')->name('store');
                Route::get('/edit/{card}', 'edit')->name('edit');
                Route::post('/edit/{card}', 'update')->name('update');
                Route::get('/destroy/{card}', 'destroy')->name('delete');
                Route::get('/detail/{detail}', 'detail_delete')->name('detail.delete');
                Route::post('/detail/create', 'detail_create')->name('detail.create');
                Route::get('/show/{card}', 'show')->name('show');
            });

            //         Route::name('users.')->prefix('users')->group(function () {
            ////             Route::get('/', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('index');
            ////             Route::get('/create', [App\Http\Controllers\Admin\UsersController::class, 'create'])->name('create');
            ////             Route::post('/create', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('store');
            ////             Route::get('/edit/{user}', [App\Http\Controllers\Admin\UsersController::class, 'edit'])->name('edit');
            ////             Route::post('/edit/{user}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('update');
            ////             Route::get('/delete/{user}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('delete');
            //
            //
            //
            //         });

            Route::resource('super_admins', App\Http\Controllers\Admin\SuperAdminController::class);
            Route::post('super_admins/actions', [App\Http\Controllers\Admin\SuperAdminController::class, 'actions'])->name('super_admins.actions');
            Route::get('super_admins/update-status/{id}', [App\Http\Controllers\Admin\SuperAdminController::class, 'update_status'])->name('super_admins.update-status');
            Route::get('super_admins/update-featured/{id}', [App\Http\Controllers\Admin\SuperAdminController::class, 'update_featured'])->name('super_admins.update-featured');


            Route::resource('admins', App\Http\Controllers\Admin\AdminController::class);
            Route::post('admins/actions', [App\Http\Controllers\Admin\AdminController::class, 'actions'])->name('admins.actions');
            Route::get('admins/update-status/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_status'])->name('admins.update-status');
            Route::get('admins/update-featured/{id}', [App\Http\Controllers\Admin\AdminController::class, 'update_featured'])->name('admins.update-featured');


            // Route::get("migrate", function () {
            //     // Artisan::call("migrate");
            // });


            Route::resource('products', ProductController::class);
            Route::post('products/actions', [ProductController::class, 'actions'])->name('products.actions');
            Route::get('products/update-status/{id}', [ProductController::class, 'update_status'])->name('products.update-status');
            Route::get('products/update-featured/{id}', [ProductController::class, 'update_featured'])->name('products.update-featured');


            Route::resource('categories', CategoryController::class);
            Route::post('categories/actions', [CategoryController::class, 'actions'])->name('categories.actions');
            Route::get('categories/update-status/{id}', [CategoryController::class, 'update_status'])->name('categories.update-status');
            Route::get('categories/update-featured/{id}', [CategoryController::class, 'update_featured'])->name('categories.update-featured');

            Route::resource('products', ProductController::class);
            Route::post('products/actions', [ProductController::class, 'actions'])->name('products.actions');
            Route::get('products/update-status/{id}', [ProductController::class, 'update_status'])->name('products.update-status');
            Route::get('products/update-featured/{id}', [ProductController::class, 'update_featured'])->name('products.update-featured');


            //--------------- Start Menus -----------------------------------------------------------------------//
            Route::resource('menus', MenueController::class);
            Route::get('show-menu-tree', [MenueController::class, 'show_tree'])->name('menus.show_tree');
            Route::post('menus/actions', [MenueController::class, 'actions'])->name('menus.actions');
            Route::get('menus/update-status/{id}', [MenueController::class, 'update_status'])->name('menus.update-status');
            Route::get('tree/get-urls', [MenueController::class, 'getUrl'])->name('menus.getUrl');
            Route::get('get-menus', [MenueController::class, 'getMenus'])->name('menus.getMenus');
            //--------------- End Menus -----------------------------------------------------------------------//

            //----------------Start Sliders----------------------------//
            Route::resource('slider', SliderController::class);
            Route::get('slider/update-status/{id}', [SliderController::class, 'update_status'])->name('slider.update-status');
            Route::post('slider/actions', [SliderController::class, 'actions'])->name('slider.actions');
            //----------------End Sliders----------------------------//


            // ----- Pages -----------------------------------------------
            Route::resource('pages', PagesController::class);
            Route::get('pages/update-status/{id}', [PagesController::class, 'update_status'])->name('pages.update-status');
            Route::post('pages/actions', [PagesController::class, 'actions'])->name('pages.actions');
            // ----- End Pages -------------------------------------------

            // ----- ads -----------------------------------------------
            Route::resource('ads', AdsController::class);
            Route::get('ads/update-status/{id}', [AdsController::class, 'update_status'])->name('ads.update-status');
            Route::get('ads/update-feature/{id}', [AdsController::class, 'update_feature'])->name('ads.update-feature');
            Route::post('ads/actions', [AdsController::class, 'actions'])->name('ads.actions');
            // ----- End ads -------------------------------------------

            // ----- Cities -----------------------------------------------
            Route::resource('cities', CityController::class);
            Route::get('cities/update-status/{id}', [CityController::class, 'update_status'])->name('cities.update-status');
            Route::post('cities/actions', [CityController::class, 'actions'])->name('cities.actions');
            // ----- End Cities -------------------------------------------

            // ----- District -----------------------------------------------
            Route::resource('districts', DistrictController::class);
            Route::get('districts/update-status/{id}', [DistrictController::class, 'update_status'])->name('districts.update-status');
            Route::post('districts/actions', [DistrictController::class, 'actions'])->name('districts.actions');
            // ----- End District -------------------------------------------

            // upload images in ckeditor
            Route::post('upload', [UploadeImageTexteditor::class, 'upload'])->name('ckeditor.upload');


            // --------- marketer coupon --------
            Route::post('/marketer-create-coupon', [App\Http\Controllers\Admin\CouponController::class, 'storeForMarketer'])->name('coupon_marketers.store');


            // ----- End reviews -------------------------------------------
            Route::resource('reviews', ReviewController::class);
            Route::get('reviews/update-status/{id}', [ReviewController::class, 'update_status'])->name('reviews.update-status');
            Route::get('reviews/update-feature/{id}', [ReviewController::class, 'update_feature'])->name('reviews.update-feature');
            Route::post('reviews/actions', [ReviewController::class, 'actions'])->name('reviews.actions');
            // ----- End Pages -------------------------------------------


            // ---------- settings --------------------------------------------
            Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
            Route::get('settings/{key}', [SettingsController::class, 'form'])->name('settings.form');
            Route::post('settings-update/{id}', [SettingsController::class, 'form_update'])->name('settings.update');
            Route::post('settings-update-custom/{slug}', [SettingsController::class, 'form_update_custom'])->name('settings.update-custom');
            // ----- End settings -------------------------------------------
            // ---------- payment_methods --------------------------------------------
            Route::resource('payment_methods', PaymentMethodController::class);
            Route::get('payment_methods/update-available_in_cart/{id}', [PaymentMethodController::class, 'update_available_in_cart'])->name('payment_methods.update-available_in_cart');
            Route::get('payment_methods/update-status/{id}', [PaymentMethodController::class, 'update_status'])->name('payment_methods.update-status');
            Route::post('payment_methods/actions', [PaymentMethodController::class, 'actions'])->name('payment_methods.actions');
            // ----- End payment_methods -------------------------------------------

            // ---------- clients_reports --------------------------------------------
            Route::get('reports/clients', [\App\Http\Controllers\Admin\ClientReportController::class, 'index'])->name('clients.reports.index');
            // ----- End clients_reports -------------------------------------------

            // ---------- clients_reports --------------------------------------------
            Route::get('reports/product-daily-income', [\App\Http\Controllers\Admin\DailyProductsIncomeReportsController::class, 'index'])->name('products_daily_income.reports.index');
            // ----- End clients_reports -------------------------------------------

        });
    });
});
