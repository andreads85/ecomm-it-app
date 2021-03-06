<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductController;

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

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', 'App\Http\Controllers\API\AuthController@login');



// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/carts', 'App\Http\Controllers\API\CartController@index');
    Route::get('/products', 'App\Http\Controllers\API\ProductController@index');
    Route::post('/products/add_to_cart', 'App\Http\Controllers\API\ProductController@addToCart');
    Route::post('/products/remove_from_cart', 'App\Http\Controllers\API\ProductController@removeFromCart')->name('removeFromCart');
});