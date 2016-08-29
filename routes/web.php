<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'AddressController@addressesList')->name('addresses-list');
Route::get('/address-form', 'AddressController@addressForm')->name('address-form');
Route::post('/address-create', 'AddressController@addressCreate')->name('address-create');
