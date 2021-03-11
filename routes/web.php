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

Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::prefix('stores')->name('stores.')->group(function () {
        Route::get('/', '\\App\\Http\\Controllers\\Admin\\StoreController@index')->name('index');
        Route::get('/create', '\\App\\Http\\Controllers\\Admin\\StoreController@create')->name('create');
        Route::post('/store', '\\App\\Http\\Controllers\\Admin\\StoreController@store')->name('store');
        Route::get('/edit/{id}', '\\App\\Http\\Controllers\\Admin\\StoreController@edit')->name('edit');;
        Route::post('/update/{id}', '\\App\\Http\\Controllers\\Admin\\StoreController@update')->name('update');;
        Route::get('/destroy/{id}', '\\App\\Http\\Controllers\\Admin\\StoreController@destroy')->name('destroy');;
    });

    // Route::prefix('products')->name('products.')->group(function () {
        Route::resource('products', '\\App\\Http\\Controllers\\Admin\\ProductController');
    // });
});