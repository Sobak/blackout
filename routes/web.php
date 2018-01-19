<?php

Route::get('install', 'InstallController@intro')->name('install');
Route::get('install/account', 'InstallController@account')->name('install.account');
Route::post('install/account', 'InstallController@accountPost');
Route::get('install/database', 'InstallController@database')->name('install.database');
Route::post('install/database', 'InstallController@databasePost');
