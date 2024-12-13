<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login.post');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('orders', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}/edit', [App\Http\Controllers\Admin\AdminController::class, 'edit'])->name('admin.orders.edit');
    Route::patch('orders/{order}', [App\Http\Controllers\Admin\AdminController::class, 'updateStatus'])->name('admin.orders.update');
    Route::post('admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout.post');
});
