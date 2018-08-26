<?php

Route::get('banned', 'BannedController@index')->name('banned');
Route::get('logout', 'UserController@logout')->name('user.logout');
