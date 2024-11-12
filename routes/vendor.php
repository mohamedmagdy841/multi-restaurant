<?php

### Vendor ###
use App\Http\Controllers\ManageOrderController;
use App\Http\Controllers\Vendor\CouponController;
use App\Http\Controllers\Vendor\GalleryController;
use App\Http\Controllers\Vendor\MenuController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\VendorAuthController;
use App\Http\Controllers\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

Route::prefix('vendor')->name('vendor.')->controller(VendorAuthController::class)->group(function () {
    Route::get('register', 'vendorRegisterForm')->name('register')->middleware('guest:vendor');
    Route::post('register_submit', 'vendorRegisterSubmit')->name('register_submit');
    Route::get('login', 'vendorLoginForm')->name('login')->middleware('guest:vendor');
    Route::post('login_submit', 'vendorLoginSubmit')->name('login_submit');
    Route::get('logout', 'vendorLogout')->name('logout');
    require __DIR__.'/vendorAuth.php';
});

Route::middleware('vendor')->group(function () {

    Route::prefix('vendor')->name('vendor.')->controller(VendorController::class)->group(function () {
        Route::get('dashboard', 'vendorDashboard')->name('dashboard');
        Route::get('profile', 'vendorProfile')->name('profile');
        Route::post('profile/store', 'vendorProfileStore')->name('profile_store');
        Route::get('change/password', 'vendorChangePassword')->name('change_password');
        Route::post('password/update', 'vendorPasswordUpdate')->name('password_update');
    });

    Route::middleware('status')->group(function () {

        ### Menu ###
        Route::prefix('vendor')->controller(MenuController::class)->group(function() {
            Route::get('/all/menu', 'allMenu')->name('all.menu');
            Route::get('/add/menu', 'addMenu')->name('add.menu');
            Route::post('/store/menu', 'storeMenu')->name('menu.store');
            Route::get('/edit/menu/{id}', 'editMenu')->name('edit.menu');
            Route::post('/update/menu', 'updateMenu')->name('menu.update');
            Route::get('/delete/menu/{id}', 'deleteMenu')->name('delete.menu');
        });

        ### Product ###
        Route::prefix('vendor')->controller(ProductController::class)->group(function(){
            Route::get('/all/product', 'allProduct')->name('all.product');
            Route::get('/add/product', 'addProduct')->name('add.product');
            Route::post('/store/product', 'storeProduct')->name('product.store');
            Route::get('/edit/product/{id}', 'editProduct')->name('edit.product');
            Route::post('/update/product', 'updateProduct')->name('product.update');
            Route::get('/delete/product/{id}', 'deleteProduct')->name('delete.product');
        });

        ### Gallery ###
        Route::prefix('vendor')->controller(GalleryController::class)->group(function() {
            Route::get('/all/gallery', 'allGallery')->name('all.gallery');
            Route::get('/add/gallery', 'addGallery')->name('add.gallery');
            Route::post('/store/gallery', 'storeGallery')->name('gallery.store');
            Route::get('/edit/gallery/{id}', 'editGallery')->name('edit.gallery');
            Route::post('/update/gallery', 'updateGallery')->name('gallery.update');
            Route::get('/delete/gallery/{id}', 'deleteGallery')->name('delete.gallery');
        });

        ### Coupon ###
        Route::prefix('vendor')->controller(CouponController::class)->group(function() {
            Route::get('/all/coupon', 'allCoupon')->name('all.coupon');
            Route::get('/add/coupon', 'addCoupon')->name('add.coupon');
            Route::post('/store/coupon', 'storeCoupon')->name('coupon.store');
            Route::get('/edit/coupon/{id}', 'editCoupon')->name('edit.coupon');
            Route::post('/update/coupon', 'updateCoupon')->name('coupon.update');
            Route::get('/delete/coupon/{id}', 'deleteCoupon')->name('delete.coupon');
        });

        ### Orders ###
        Route::controller(ManageOrderController::class)->group(function(){
            Route::get('/all/vendor/orders', 'allVendorOrders')->name('all.vendor.orders');
            Route::get('/vendor/order/details/{id}', 'vendorOrderDetails')->name('vendor.order.details');
        });
    });
});

