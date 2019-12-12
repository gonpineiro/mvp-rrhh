<?php
  Route::get('/users', 'UserController@showUsers')->middleware('can:users.show');
  Route::post('/create_user', 'UserController@createUser')->middleware('can:users.create');
  Route::get('/edit_user/{id}', 'UserController@editUser')->middleware('can:users.edit');
  Route::get('/edit_sup_user/{id}', 'UserController@editSupuser')->middleware('can:users.edit');
  Route::post('/update_user/{id}', 'UserController@updateUser')->middleware('can:users.edit');

  Route::get('/sup_users', 'SupervisorController@showSupusers')->middleware('can:users.show');
  Route::get('/add_sup_user/{id}', 'SupervisorController@addSupuser')->middleware('can:users.show');
  Route::get('/show_vigs/{id}', 'SupervisorController@showVigs')->middleware('can:users.show');
  Route::get('/show_vigs_sup', 'SupervisorController@showVigssup')->middleware('can:supervisor');
  Route::post('/create_sup_user', 'SupervisorController@createSupuser')->middleware('can:users.create');
  Route::get('/report_vig/{id}', 'SupervisorController@reportVig')->middleware('can:supervisor');
  Route::get('/change_estate/{id}', 'SupervisorController@changeEstate')->middleware('can:supervisor');
  Route::get('/show_vigs_sup/reports', 'SupervisorController@showReportvig')->middleware('can:supervisor');
 ?>
