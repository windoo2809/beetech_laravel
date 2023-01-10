<?php

use Illuminate\Support\Facades\Route;
//UserController
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\User\ShowProductCategoryController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\OrderDetailController;
use App\Http\Controllers\User\LangController;

//AdminController
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Admin\ShowUserController;
use App\Models\Order;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('auth')->group(function () {
    //user-login
    Route::get('user-login', [UserController::class, 'getLogin'])->name('user.layout.login');
    Route::post('user-login', [UserController::class, 'postLogin'])->name('user.layout.login');
    //user-register
    Route::get('user-register', [UserController::class, 'getRegister'])->name('user.layout.register');
    Route::post('user-register', [UserController::class, 'postRegister'])->name('user.layout.register');
    //user-foget pass
    Route::get('user-fogot', [UserController::class, 'getForgot'])->name('user.layout.forgot');
    Route::post('user-fogot', [UserController::class, 'postForgot'])->name('user.layout.forgot');
    Route::get('user-reset-password', [UserController::class, 'getResetPassword'])->name('user.layout.resetpassword');
    Route::post('user-reset-password', [UserController::class, 'postResetPassword'])->name('user.layout.resetpassword');
    //admin login
    Route::get('admin-login', [AdminController::class, 'getLogin'])->name('admin.layout.login');
    Route::post('admin-login', [AdminController::class, 'postLogin'])->name('admin.layout.login');
    //admin register
    Route::get('admin-register', [AdminController::class, 'getRegister'])->name('admin.layout.register');
    Route::post('admin-register', [AdminController::class, 'postRegister'])->name('admin.layout.register');
});

//auth-user
Route::prefix('user')->middleware('user.login')->group(function () {
    Route::get('lang/{locale}', [LangController::class, 'index'])->name('lang');
    Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
    //logout
    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
    //crud product-category
    Route::resource('product-category', ShowProductCategoryController::class);
    //crud product
    Route::resource('product', ProductController::class);
    Route::get('/export-csv', [ProductController::class, 'exportcsv'])->name('product.exportcsv');
    Route::get('/export-pdf', [ProductController::class, 'exportpdf'])->name('product.exportpdf');
    //crud order
    Route::resource('order', OrderController::class);
    Route::get('/order-pdf/{id}', [OrderController::class, 'viewPDF']);
    Route::get('/order-pdf/down/{id}', [OrderController::class, 'downPDF']);
});
//end-user

//auth-admin
Route::prefix('admin')->middleware('admin.login')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    //logout
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    //crud-user
    Route::resource('user', ShowUserController::class);

    Route::get('/get-district', [ShowUserController::class, 'getDistrict'])->name('user.district');
    Route::get('/get-commune', [ShowUserController::class, 'getCommune'])->name('user.commune');
});
//end-admin
