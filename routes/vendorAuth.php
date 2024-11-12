<?php


use App\Http\Controllers\VendorAuth\VendorNewPasswordController;
use App\Http\Controllers\VendorAuth\VendorPasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:vendor')->group(function () {
    Route::get('forgot-password', [VendorPasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [VendorPasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [VendorNewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [VendorNewPasswordController::class, 'store'])
        ->name('password.store');
});

