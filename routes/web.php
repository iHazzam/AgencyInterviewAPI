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

Route::get('/', 'ApplicationController@showWelcome');
Route::get('/manageAPI', 'ApplicationController@manageAPI')->middleware('admin');
Auth::routes();

Route::get('/home', 'ApplicationController@index');

