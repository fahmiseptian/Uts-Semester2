<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['check.buyer']], function () {
        Route::post('/addCart', [CartController::class, 'addCart']);
        Route::get('/cart', [CartController::class, 'show_cart'])->name('cart');
        Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
        Route::post('/checkout/finished', [CartController::class, 'storeCheckout'])->name('cart.checkout.finished');
    });

    Route::get('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
    Route::post('/admin/store-login', [AuthAdminController::class, 'login']);
    Route::get('/admin/login', [AuthAdminController::class, 'index']);

    Route::group(['middleware' => ['check.admin']], function () {
        Route::get('/admin', [HomeAdminController::class, 'index']);
        Route::get('/admin/user', [UserAdminController::class, 'index'])->name('admin.users');
        Route::get('/admin/product', [ProductAdminController::class, 'index'])->name('admin.products');
    });
});
