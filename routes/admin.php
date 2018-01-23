<?php

Route::get('errors', 'ErrorController@index')->name('admin.errors');
Route::get('errors/clear', 'ErrorController@clear')->name('admin.errors.clear');
Route::get('errors/remove/{id}', 'ErrorController@remove')->name('admin.errors.remove');
