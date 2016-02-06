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

Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function () {

    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('menu', 'MenuController', ['except' => 'show']);
    Route::resource('index', 'IndexController', ['except' => 'show']);
    Route::resource('order', 'OrderController', ['except' => 'show']);
    Route::resource('permission', 'PermissionController', ['except' => 'show']);

    Route::group(['namespace' => 'Product'], function () {
        Route::resource('bingo-product', 'BingoProductController');
        Route::resource('branch-product', 'BranchProductController');
    });
});

Route::group(['namespace' => 'Auth'], function () {
    Route::get('auth/login', 'AuthController@getLogin');
    Route::post('auth/login', 'AuthController@postLogin');
    Route::get('auth/logout', 'AuthController@getLogout');

    Route::get('auth/register', 'AuthController@getRegister');
    Route::post('auth/register', 'AuthController@postRegister');

    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');
});

