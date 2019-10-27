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
    return view('home');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/{id?}', 'ProductController@list');
    Route::post('/{id?}', 'ProductController@store');
    Route::delete('/{id}', 'ProductController@delete');
});
