<?php

Route::get('/', 'IndexController@index')->name('index');

Route::get('contact', 'ContactController@index')->name('contact');

Route::get('credits', 'CreditsController@index')->name('credits');

Route::get('forgot-password', 'UserController@forgotPassword')->name('user.forgot-password');
Route::post('forgot-password', 'UserController@forgotPasswordPost');

Route::get('install', 'InstallController@intro')->name('install');
Route::get('install/account', 'InstallController@account')->name('install.account');
Route::post('install/account', 'InstallController@accountPost');
Route::get('install/database', 'InstallController@database')->name('install.database');
Route::post('install/database', 'InstallController@databasePost');

Route::get('login', 'UserController@login')->name('user.login');
Route::post('login', 'UserController@loginPost');

Route::get('switch-lang/{lang}', 'LanguageController@switch')->name('language.switch');
