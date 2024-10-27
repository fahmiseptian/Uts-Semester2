<?php

use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\HomeController;
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

Route::get('/admin/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/store-login', [AuthAdminController::class, 'login']);
Route::get('/admin/login', [AuthAdminController::class, 'index']);

Route::get('/', [HomeController::class, 'index']);


Route::group(['middleware' => ['check.admin']], function () {
    Route::get('/admin', [HomeAdminController::class, 'index']);
    Route::get('/admin/user', [UserAdminController::class, 'index'])->name('admin.users');
});
