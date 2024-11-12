<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FilterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\ManageOrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vendor\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('frontend.dashboard.profile');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::post('/profile/store', 'profileStore')->name('profile.store');
        Route::get('/user/logout', 'userLogout')->name('user.logout');
        Route::get('/change/password', 'changePassword')->name('change.password');
        Route::post('/user/password/update', 'userPasswordUpdate')->name('user.password.update');
    });

    // Get Wishlist data for user
    Route::get('/all/wishlist', [HomeController::class, 'allWishlist'])->name('all.wishlist');
    Route::get('/remove/wishlist/{id}', [HomeController::class, 'removeWishlist'])->name('remove.wishlist');

    Route::controller(ManageOrderController::class)->group(function(){
        Route::get('/user/order/list', 'userOrderList')->name('user.order.list');
        Route::get('/user/order/details/{id}', 'userOrderDetails')->name('user.order.details');
        Route::get('/user/invoice/download/{id}', 'userInvoiceDownload')->name('user.invoice.download');
    });
});

### User ###
Route::get('/', [UserController::class, 'index'])->name('index');

Route::get('/changeStatus', [ProductController::class, 'changeStatus']);

Route::controller(HomeController::class)->group(function(){
    Route::get('/restaurant/details/{id}', 'restaurantDetails')->name('res.details');
    Route::post('/add-wish-list/{id}', 'addWishList');
});

Route::controller(CartController::class)->group(function(){
    Route::get('/add_to_cart/{id}', 'AddToCart')->name('add_to_cart');
    Route::post('/cart/update-quantity', 'updateCartQuantity')->name('cart.updateQuantity');
    Route::post('/cart/remove', 'cartRemove')->name('cart.remove');
    Route::post('/apply-coupon', 'applyCoupon');
    Route::get('/remove-coupon', 'couponRemove');
    Route::get('/checkout', 'shopCheckout')->name('checkout');
});

Route::controller(OrderController::class)->group(function(){
    Route::post('/cash_order', 'cashOrder')->name('cash_order');
    Route::post('/stripe_order', 'stripeOrder')->name('stripe_order');
    Route::post('/mark-notification-as-read/{notification}', 'markAsRead');
});

Route::controller(ReviewController::class)->group(function(){
    Route::post('/store/review', 'storeReview')->name('store.review');

});

Route::controller(FilterController::class)->group(function(){
    Route::get('/list/restaurant', 'listRestaurant')->name('list.restaurant');
    Route::get('/filter/products', 'filterProducts')->name('filter.products');

});
require __DIR__.'/auth.php';

