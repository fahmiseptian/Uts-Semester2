<?php

use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/cache-all', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');

    // Menyimpan output dari perintah yang dijalankan
    $output = [
        'cache_clear' => Artisan::output(),
        'route_cache' => Artisan::output(),
        'config_cache' => Artisan::output(),
    ];

    // Mengembalikan respons
    return response()->json([
        'message' => 'Caches cleared and routes & config cached successfully!',
        'output' => $output,
    ]);
});

Route::post('/admin/create-user', [UserAdminController::class, 'storeUser']);
Route::post('/admin/update-user', [UserAdminController::class, 'updateUser']);
Route::post('/admin/get-user', [UserAdminController::class, 'getDataUser']);
Route::post('/admin/delete-user', [UserAdminController::class, 'deleteUser']);
Route::post('/admin/store-product', [ProductAdminController::class, 'storeProduct']);
