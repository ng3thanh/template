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

    Route::prefix('gioi-thieu')->group(function () {
        Route::get('danh-sach', 'IntroducesController@index')->name('introduce');
        Route::get('{slug}-{id}', 'IntroducesController@show')->name('introduce_detail');
    });

    Route::prefix('san-pham')->group(function () {
        Route::get('tim-kiem', 'ProductsController@search')->name('product.search');
        Route::get('danh-sach/', 'ProductsController@index')->name('product.index');
        Route::get('danh-sach/{slug}-{menu_id}', 'ProductsController@list')->name('product.list');
        Route::get('{slug}-{id}', 'ProductsController@show')->name('product.detail');
    });

    Route::prefix('tai-lieu')->group(function () {
        Route::get('/danh-sach', 'DocumentController@index')->name('document');
        Route::get('{slug}-{id}', 'DocumentController@show')->name('document_detail');
    });

    Route::prefix('lien-he')->group(function () {
        Route::get('/danh-sach', 'ContactController@index')->name('contact');
        Route::post('/gui-phan-hoi', 'ContactController@feedback')->name('feedback');
        Route::post('/dang-ki-bao-gia', 'ContactController@mailRegister')->name('mail.register');
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

    Route::get('/login', 'LoginController@getLogin')->name('get_login');
    Route::post('/login', 'LoginController@postLogin')->name('post_login');
});