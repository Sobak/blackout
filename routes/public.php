<?php

Route::get('/', 'IndexController@index')->name('index');

Route::get('forgot-password', 'UserController@forgotPassword')->name('user.forgot-password');
Route::post('forgot-password', 'UserController@forgotPasswordPost');

Route::get('install', 'InstallController@intro')->name('install');
Route::get('install/account', 'InstallController@account')->name('install.account');
Route::post('install/account', 'InstallController@accountPost');
Route::get('install/database', 'InstallController@database')->name('install.database');
Route::post('install/database', 'InstallController@databasePost');

Route::get('login', 'UserController@login')->name('user.login');
Route::post('login', 'UserController@loginPost');
