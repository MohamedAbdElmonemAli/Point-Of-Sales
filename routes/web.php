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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.signin');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Dashboard'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    });
    Route::resource('users', 'UserController');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('clients', 'ClientController');
    Route::resource('clients.orders', 'Client\OrderController');

    Route::resource('orders', 'OrderController');
    Route::get('/orders/{order}/products', 'OrderController@products')->name('orders.products');
});
