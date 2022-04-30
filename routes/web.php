<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [AdminController::class, 'index']);
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'admin_auth'], function () {
    // AdminController
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('admin/logout', [AdminController::class, 'logout']);
    // Route::get('admin/updatepassword', [AdminController::class, 'updatepassword']);

    // CategoryController
    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/add-category', [CategoryController::class, 'create']);
    Route::get('admin/category/edit-category/{id}', [CategoryController::class, 'edit']);
    Route::post('admin/category/manage-category/add', [CategoryController::class, 'add']);
    Route::post('admin/category/manage-category/update', [CategoryController::class, 'update']);
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);

    // CouponController
    Route::get('admin/coupon', [CouponController::class, 'index']);
    Route::get('admin/coupon/add-coupon', [CouponController::class, 'create']);
    Route::get('admin/coupon/edit-coupon/{id}', [CouponController::class, 'edit']);
    Route::post('admin/coupon/manage-coupon/add', [CouponController::class, 'add']);
    Route::post('admin/coupon/manage-coupon/update', [CouponController::class, 'update']);
    Route::get('admin/coupon/delete/{id}', [CouponController::class, 'delete']);
});
