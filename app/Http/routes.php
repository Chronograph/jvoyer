<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//homescreen temporary?
Route::get('/', 'ProjectController@home');

//project routes
Route::get('projects', 'ProjectController@index');
Route::post('projects', 'ProjectController@store');
Route::get('projects/{id}','ProjectController@show');
Route::post('projects/update/{id}','ProjectController@update');

Route::get('deploy', 'ProjectController@deployProject');
Route::post('deploy', 'ProjectController@deployProjectpost');

//Server routes
Route::post('servers', 'ServerController@store');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
