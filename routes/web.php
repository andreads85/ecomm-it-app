<?php

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

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/dashboard', 'App\Http\Controllers\ProductController@index')->name('dashboard');
    Route::post('/products/add_to_cart', 'App\Http\Controllers\ProductController@addToCart')->name('addToCart');
    Route::get('/cart', 'App\Http\Controllers\CartController@show')->name('cart_detail');
});

require __DIR__.'/auth.php';