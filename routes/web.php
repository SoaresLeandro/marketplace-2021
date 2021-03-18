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

Route::get('/', '\\App\\Http\\Controllers\\HomeController@index')->name('home');
Route::get('/product/{slug}', '\\App\\Http\\Controllers\\HomeController@productSingle')->name('product.single');

Route::prefix('cart')->name('cart.')->group( function () {
    Route::get('/', '\\App\\Http\\Controllers\\CartController@index')->name('index');
    Route::get('/add', '\\App\\Http\\Controllers\\CartController@add')->name('add');
    Route::get('/remove/{slug}', '\\App\\Http\\Controllers\\CartController@remove')->name('remove');
    Route::get('/cancel', '\\App\\Http\\Controllers\\CartController@cancel')->name('cancel');
});

Route::group(['middleware' => 'auth'], function () {

    Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function () {

        Route::get('/home', function () {
            return view('welcome');
        })->name('home');

        Route::prefix('stores')->name('stores.')->group(function () {
            Route::get('/', '\\App\\Http\\Controllers\\Admin\\StoreController@index')->name('index');
            Route::get('/create', '\\App\\Http\\Controllers\\Admin\\StoreController@create')->name('create');
            Route::post('/store', '\\App\\Http\\Controllers\\Admin\\StoreController@store')->name('store');
            Route::get('/edit/{id}', '\\App\\Http\\Controllers\\Admin\\StoreController@edit')->name('edit');;
            Route::post('/update/{id}', '\\App\\Http\\Controllers\\Admin\\StoreController@update')->name('update');;
            Route::get('/destroy/{id}', '\\App\\Http\\Controllers\\Admin\\StoreController@destroy')->name('destroy');;
        });

        Route::resource('products', '\\App\\Http\\Controllers\\Admin\\ProductController');

        Route::resource('categories', '\\App\\Http\\Controllers\\Admin\\CategoryController');

        Route::post('photos/remove', '\\App\\Http\\Controllers\\Admin\\ProductPhotoController@photoRemove')->name('photo.remove');
    });
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
