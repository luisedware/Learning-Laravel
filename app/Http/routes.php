<?php
// 首页控制器
Route::get('/{parent_id?}', [
    'where'      => ['parent_id' => '[0-9]+'],
    'as'         => 'index.index',
    'uses'       => 'Backend\IndexController@index',
    'middleware' => ['auth']
]);

// 系统配置
Route::group(['namespace' => 'Backend', 'middleware' => ['auth']], function () {
    Route::resource('user', 'UserController');
    Route::resource('menu', 'MenuController');
    Route::post('role/updatePermission',
        ['uses' => 'RoleController@updatePermission', 'as' => 'role.update.permission']);
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
});

// 权限控制错误提示
Route::get('errors/denied', function () {
    return view('errors.denied');
});

// 登录认证
Route::group(['namespace' => 'Auth'], function () {
    Route::get('auth/login', 'AuthController@getLogin');
    Route::post('auth/login', 'AuthController@postLogin');
    Route::get('auth/logout', 'AuthController@getLogout');
});
