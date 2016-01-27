<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Admin'], function () {

    Route::resource('user', 'UserController');
    Route::resource('menu', 'MenuController', ['except' => 'show']);
    Route::resource('index', 'IndexController');
    Route::resource('order', 'OrderController');

    Route::group(['namespace' => 'Product'], function () {
        Route::resource('bingo-product', 'BingoProductController');
        Route::resource('branch-product', 'BranchProductController');
    });
});
