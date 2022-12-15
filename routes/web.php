<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
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
});
Route::prefix('auth-user')->group(function (){
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
Route::prefix('admin-auth')->group(function (){
    //login
    Route::get('login', [AdminController::class, 'getLogin'])->name('admin.layout.login');
    Route::post('login', [AdminController::class, 'postLogin'])->name('admin.layout.login');

    //register
    Route::get('register', [AdminController::class, 'getRegister'])->name('admin.layout.register');
    Route::post('register', [AdminController::class, 'postRegister'])->name('admin.layout.register');
});
//end-admin