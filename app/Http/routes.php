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

Route::group(['namespace' => 'Admin', 'middleware' => ['auth']], function () {

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

    Route::get('upload', ['as' => 'upload.index', 'uses' => 'UploadController@index']);
    Route::post('upload/file', 'UploadController@createFile');
    Route::delete('upload/file', 'UploadController@deleteFile');
    Route::post('upload/folder', 'UploadController@createFolder');
    Route::delete('upload/folder', 'UploadController@deleteFolder');
});

Route::group(['namespace' => 'Auth'], function () {
    //用户登录页面与操作
    Route::get('auth/login', 'AuthController@getLogin');
    Route::post('auth/login', 'AuthController@postLogin');
    Route::get('auth/logout', 'AuthController@getLogout');

    //用户注册页面与操作
    Route::get('auth/register', 'AuthController@getRegister');
    Route::post('auth/register', 'AuthController@postRegister');

    //用户重设密码页面与操作
    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');
    Route::get('password/reset/{token}', 'PasswordController@getReset');
    Route::post('password/reset', 'PasswordController@postReset');
});

