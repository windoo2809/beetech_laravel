<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//register customer
Route::post('register',[AuthController::class, 'postRegister']);
//login customer
Route::post('login',[AuthController::class, 'postLogin']);

Route::middleware('auth:api')->group(function () {
    //show customer
    Route::get('customer' , [CustomerController::class, 'index']);
    //showinfor
    Route::get('customer/infor', [CustomerController::class, 'me']);
    //update
    Route::post('customer/update/' , [CustomerController::class, 'update']);
    //show product
    Route::get('product' , [ProductController::class, 'index']);
    //infor product
    Route::get('product/infor/{id}' , [ProductController::class, 'show']);
    //product cart
    Route::post('product/orders/' , [OrderController::class, 'order']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
