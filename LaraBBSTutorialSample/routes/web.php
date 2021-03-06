<?php
Route::get('/', 'PagesController@root')->name('root');
// 无权限路由
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Users
Route::resource('users', 'UsersController');

// Topics
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

// Categories
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

// Replies
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

// Notifications
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);