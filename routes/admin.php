<?php

Route::get('chat', 'ChatController@index')->name('admin.chat');
Route::get('chat/clear', 'ChatController@clear')->name('admin.chat.clear');
Route::get('chat/remove/{id}', 'ChatController@remove')->name('admin.chat.remove');

Route::get('errors', 'ErrorController@index')->name('admin.errors');
Route::get('errors/clear', 'ErrorController@clear')->name('admin.errors.clear');
Route::get('errors/remove/{id}', 'ErrorController@remove')->name('admin.errors.remove');

Route::get('resources_add', 'ResourceController@add')->name('admin.resource.add');
Route::post('resources_add', 'ResourceController@addPost');
Route::get('resources_subtract', 'ResourceController@subtract')->name('admin.resource.subtract');
Route::post('resources_subtract', 'ResourceController@subtractPost');
