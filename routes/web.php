<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\AdminController;


Route::get('/', function () {
    return view('welcome');
});

//auth-user
Route::prefix('user')->middleware('auth')->group(function (){
    Route::get('user', 
    [UserController::class, 'index']);

});
//login
Route::get('user-login', [UserController::class, 'getLogin'])->name('user.layout.login');
Route::post('user', [UserController::class, 'postLogin'])->name('user.layout.login');
//register
Route::get('user-register', [UserController::class, 'getRegister'])->name('user.layout.register');
Route::post('user-register', [UserController::class, 'postRegister'])->name('user.layout.register');
//end-user

//auth-admin
Route::prefix('admin')->middleware('auth')->group(function (){
    Route::get('admin', 
    [AdminController::class, 'index']);

});
//login
Route::get('admin-login', [AdminController::class, 'getLogin'])->name('admin.layout.login');
Route::post('admin', [AdminController::class, 'postLogin'])->name('admin.layout.login');
//register
Route::get('admin-register', [AdminController::class, 'getRegister'])->name('admin.layout.register');
Route::post('admin-register', [AdminController::class, 'postRegister'])->name('admin.layout.register');
//end-admin