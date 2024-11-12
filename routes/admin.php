<?php

### Admin ###
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ManageBannerController;
use App\Http\Controllers\Admin\ManageProductController;
use App\Http\Controllers\Admin\ManageRestaurantController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\ManageOrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->controller(AdminAuthController::class)->group(function () {

    Route::get('login', 'adminLoginForm')->name('login')->middleware('guest:admin');
    Route::post('login_submit', 'adminLoginSubmit')->name('login_submit');
    Route::get('logout', 'adminLogout')->name('logout');
    require __DIR__.'/adminAuth.php';

});

Route::middleware('admin')->group(function () {

    ### Dashboard ###
    Route::prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
        Route::get('dashboard', 'adminDashboard')->name('dashboard');
        Route::get('profile', 'adminProfile')->name('profile');
        Route::get('change/password', 'adminProfileChangePassword')->name('change_password');
        Route::post('password/update', 'adminProfilePasswordUpdate')->name('password_update');
        Route::post('profile/store', 'adminProfileStore')->name('profile_store');
    });

    ### Category ###
    Route::prefix('admin')->controller(CategoryController::class)->group(function(){
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');

    });

    ### City ###
    Route::prefix('admin')->controller(CityController::class)->group(function() {
        Route::get('/all/city', 'allCity')->name('all.city');
        Route::post('/store/city', 'storeCity')->name('city.store');
        Route::get('/edit/city/{id}', 'editCity');
        Route::post('/update/city', 'updateCity')->name('city.update');
        Route::get('/delete/city/{id}', 'deleteCity')->name('delete.city');
    });

    ### Manage Products ###
    Route::prefix('admin')->name('admin.')->controller(ManageProductController::class)->group(function(){
        Route::get('all/product', 'adminAllProduct')->name('all.product');
        Route::get('add/product', 'adminAddProduct')->name('add.product');
        Route::post('store/product', 'adminStoreProduct')->name('product.store');
        Route::get('edit/product/{id}', 'adminEditProduct')->name('edit.product');
        Route::post('update/product', 'adminUpdateProduct')->name('product.update');
        Route::get('delete/product/{id}', 'adminDeleteProduct')->name('delete.product');

    });

    ### Manage Restaurants ###
    Route::prefix('admin')->controller(ManageRestaurantController::class)->group(function(){
        Route::get('/pending/restaurant', 'pendingRestaurant')->name('pending.restaurant');
        Route::get('/vendorchangeStatus', 'vendorChangeStatus');
        Route::get('/approve/restaurant', 'approveRestaurant')->name('approve.restaurant');

    });

    ### Manage Banners ###
    Route::prefix('admin')->controller(ManageBannerController::class)->group(function(){
        Route::get('/all/banner', 'allBanner')->name('all.banner');
        Route::post('/banner/store', 'bannerStore')->name('banner.store');
        Route::get('/edit/banner/{id}', 'editBanner');
        Route::post('/banner/update', 'bannerUpdate')->name('banner.update');
        Route::get('/delete/banner/{id}', 'deleteBanner')->name('delete.banner');

    });

    ### Manage Orders ###
    Route::prefix('admin')->controller(ManageOrderController::class)->group(function(){
        Route::get('/pending/order', 'pendingOrder')->name('pending.order');
        Route::get('/confirm/order', 'confirmOrder')->name('confirm.order');
        Route::get('/processing/order', 'processingOrder')->name('processing.order');
        Route::get('/delivered/order', 'deliveredOrder')->name('delivered.order');
        Route::get('/admin/order/details/{id}', 'adminOrderDetails')->name('admin.order.details');
        Route::get('/pending_to_confirm/{id}', 'pendingToConfirm')->name('pending_to_confirm');
        Route::get('/confirm_to_processing/{id}', 'confirmToProcessing')->name('confirm_to_processing');
        Route::get('/processing_to_delivered/{id}', 'processingToDelivered')->name('processing_to_delivered');
    });

    ### Manage Search ###
    Route::prefix('admin')->name('admin.')->controller(ReportController::class)->group(function(){
        Route::get('all/reports', 'adminAllReports')->name('all.reports');
        Route::post('search/bydate', 'adminSearchByDate')->name('search.bydate');
        Route::post('search/bymonth', 'adminSearchByMonth')->name('search.bymonth');
        Route::post('search/byyear', 'adminSearchByYear')->name('search.byyear');
    });
});
