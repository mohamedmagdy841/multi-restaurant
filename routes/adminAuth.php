<?php


use App\Http\Controllers\AdminAuth\AdminNewPasswordController;
use App\Http\Controllers\AdminAuth\AdminPasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [AdminNewPasswordController::class, 'store'])
        ->name('password.store');
});

