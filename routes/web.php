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


Route::get('/', 			'TaskController@getTasks');
Route::get('/edit/{id}', 	'TaskController@editTask');
Route::get('/edit', 		'TaskController@createTask');
Route::post('/edit/submit', 'TaskController@submit');
Route::post('/edit/edit', 	'TaskController@updateTask');
Route::get('/delete/{id}', 	'TaskController@delete');
Auth::routes();
Route::get('/{id}', 		'TaskController@getTask');

Auth::routes();
