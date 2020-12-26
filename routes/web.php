<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('product', 'ProductController')->middleware('role');;
    Route::get('/category/{id}', 'CategoryController@getProduct')->name('get.product');
    Route::post('/cart/store', 'CartController@store')->name('cart.store');
    Route::get('cart/index', 'CartController@index')->name('cart.index');
    Route::delete('/cart/{id}', 'CartController@destroy')->name('cart.destroy');
});
