<?php

use Illuminate\Support\Facades\Route;
//UserController
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\ShowProductCategoryController;
use App\Http\Controllers\user\ProductController;

//AdminController
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ShowUserController;



Route::get('/', function () {
    return view('welcome');
});

//auth-user
Route::prefix('user')->middleware('user.login')->group(function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
//logout
    Route::post('logout', [UserController::class, 'logout'])->name('user.logout');
//crud product-category
    Route::resource('product-category', ShowProductCategoryController::class);
//crud product
    Route::resource('product', ProductController::class);
    Route::post('product/destroy', [ProductController::class,'destroy']);
    Route::get('/export-csv', [ProductController::class, 'exportcsv'])->name('product.exportcsv');
    Route::get('/export-pdf', [ProductController::class, 'exportpdf'])->name('product.exportpdf');
});

Route::prefix('user')->group(function (){
//login
    Route::get('login', [UserController::class, 'getLogin'])->name('user.layout.login');
    Route::post('login', [UserController::class, 'postLogin'])->name('user.layout.login'); 

//register
    Route::get('register', [UserController::class, 'getRegister'])->name('user.layout.register');
    Route::post('register', [UserController::class, 'postRegister'])->name('user.layout.register');

});
//end-user

//auth-admin
Route::prefix('admin')->middleware('admin.login')->group(function(){
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//logout
    Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
//crud-user
    Route::resource('user', ShowUserController::class);
});
Route::prefix('admin')->group(function (){
    //login
    Route::get('login', [AdminController::class, 'getLogin'])->name('admin.layout.login');
    Route::post('login', [AdminController::class, 'postLogin'])->name('admin.layout.login');

    //register
    Route::get('register', [AdminController::class, 'getRegister'])->name('admin.layout.register');
    Route::post('register', [AdminController::class, 'postRegister'])->name('admin.layout.register');
});
//end-admin