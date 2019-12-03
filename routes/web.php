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
require __DIR__ . '/web/auth.php';


Route::group(['middleware' => 'auth'], function () {
  Route::get('/', 'HomeController@index')->name('home')->middleware('can:computadoras.show');
  Route::get('/users', 'UserController@showUsers')->middleware('can:computadoras.show');
  Route::get('/users', 'UserController@showUsers')->middleware('can:users.show');
  Route::post('/create_user', 'UserController@createUser')->middleware('can:users.create');
  Route::get('/edit_user/{id}', 'UserController@editUser')->middleware('can:users.edit');
  Route::post('/update_user/{id}', 'UserController@updateUser')->middleware('can:users.edit');
});
