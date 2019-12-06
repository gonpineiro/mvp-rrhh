<?php
  Route::get('/users', 'UserController@showUsers')->middleware('can:users.show');
  Route::post('/create_user', 'UserController@createUser')->middleware('can:users.create');
  Route::get('/edit_user/{id}', 'UserController@editUser')->middleware('can:users.edit');
  Route::post('/update_user/{id}', 'UserController@updateUser')->middleware('can:users.edit');


  Route::get('/sup_users', 'UserController@showSupusers')->middleware('can:users.show');
  Route::get('/add_sup_user/{id}', 'UserController@addSupuser')->middleware('can:users.show');
  Route::get('/show_vigs/{id}', 'UserController@showVigs')->middleware('can:users.show');
  Route::get('/show_vigs_sup', 'UserController@showVigssup')->middleware('can:supervisor');
  Route::post('/create_sup_user', 'UserController@createSupuser')->middleware('can:users.create');
 ?>
