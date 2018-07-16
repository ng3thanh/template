<?php

use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

Route::middleware('guest')->namespace('Web')->group(function () {
    Route::get('/', 'MainController@index')->name('main');

    Route::prefix('introduce')->group(function () {
        Route::get('list', 'IntroducesController@index')->name('introduce');
        Route::get('{slug}-{id}', 'IntroducesController@show')->name('introduce.detail');
    });

    Route::prefix('product')->group(function () {
        Route::get('search', 'ProductsController@search')->name('product.search');
        Route::get('list/', 'ProductsController@index')->name('product.index');
        Route::get('list/{slug}-{menu_id}', 'ProductsController@list')->name('product.list');
        Route::get('{slug}-{id}', 'ProductsController@show')->name('product.detail');
    });

    Route::prefix('document')->group(function () {
        Route::get('/document', 'DocumentController@index')->name('document');
        Route::get('{slug}-{id}', 'DocumentController@show')->name('document.detail');
    });

    Route::prefix('contact')->group(function () {
        Route::get('/list', 'ContactController@index')->name('contact');
        Route::post('/feedback', 'ContactController@feedback')->name('feedback');
    });
});

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::prefix('management')->middleware('admin')->group(function () {
        Route::get('/', 'MainController@index')->name('dashboard');

        Route::resource('product', 'ProductController');
        Route::resource('news', 'NewsController');
        Route::resource('contact', 'ContactController');
        Route::resource('user', 'UserController');

        Route::get('copy-product/{id}', 'ProductController@copy')->name('product.copy');
        Route::get('order-product', 'ProductController@order')->name('product.order');
        Route::post('change-order-product', 'ProductController@changeOrder')->name('product.change.order');
        Route::get('list-menu', 'ProductController@listMenu')->name('menu.index');
        Route::get('create-menu', 'ProductController@createMenu')->name('menu.create');
        Route::get('edit-menu/{id}', 'ProductController@editMenu')->name('menu.edit');
        Route::post('create-menu', 'ProductController@storeMenu')->name('menu.store');
        Route::post('edit-menu/{id}', 'ProductController@updateMenu')->name('menu.update');
        Route::post('delete-menu/{id}', 'ProductController@destroyMenu')->name('menu.destroy');
    });
});

Route::middleware('guest')->namespace('Auth')->group(function () {
    Route::get('/login', 'LoginController@getLogin')->name('login.get');
    Route::post('/login', 'LoginController@postLogin')->name('login.post');
});
