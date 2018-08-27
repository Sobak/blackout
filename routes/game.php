<?php

Route::get('banned', 'BannedController@index')->name('banned');

Route::get('chat', 'ChatController@index')->name('chat');
Route::post('chat', 'ChatController@create');
Route::get('chat/messages', 'ChatController@messages')->name('chat.messages');

Route::get('logout', 'UserController@logout')->name('user.logout');
