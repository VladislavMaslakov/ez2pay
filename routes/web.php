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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', '\App\Http\Controllers\ProductsController@index')->name('dashboard');
    Route::get('/product/{id}', '\App\Http\Controllers\ProductsController@show')->name('product.show');
    Route::get('/addToCart/{id}', '\App\Http\Controllers\ProductsController@addToCart')->name('product.add_to_cart');
    Route::get('/cart/', function(){
        return view('sections.cart.index');
    })->name('cart');
    Route::get('/checkout', '\App\Http\Controllers\CheckoutController@checkout')->name('checkout');
});


Route::middleware(['auth', 'seller'])->group(function() {
    Route::get('/admin/products/list', 'App\Http\Controllers\Admin\ProductsController@list')->name('admin.products.list');
    Route::resource('/admin/products', 'App\Http\Controllers\Admin\ProductsController');
});

require __DIR__.'/auth.php';
