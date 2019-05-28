<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ParticipController@index');
Route::get('/index', 'ParticipController@index');
Route::get('/userslist', 'UserController@list')->name('userslist');
Auth::routes();
Route::get('/index2', function () { return 'Hello World';});
Route::get('/home', 'ParticipController@index')->name('home');
Route::resource('users', 'UserController');
Route::resource('sors', 'SorController');
Route::resource('particips', 'ParticipController');
Route::resource('usertemps', 'UsertempController');
Route::get('users/{user}/destroy', 'UserController@destroyForm');
Route::get('sors/{sor}/destroy', 'SorController@destroyForm');
Route::get('particips/{particip}/destroy', 'ParticipController@destroyForm');
//cree une participation mode admin
Route::get('/partarchive', 'ParticipController@partarchive');
//archives sorties
Route::get('/partcreate', 'ParticipController@cree2');
//gestion email
Route::resource('send', 'EmailController');
Route::post('/send2','EmailController@send2')->name('send2');
//import csv
Route::get('export', 'MyController@export')->name('export');
Route::get('importExportView', 'MyController@importExportView');
Route::post('import', 'MyController@import')->name('import');
Route::get('/users2', 'UserController@index2');
Route::put('users2/{user}', 'UserController@update2')->name('users.update2');

