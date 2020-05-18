<?php
  Route::get('/users', 'UserController@showUsers')->middleware('can:users.show');
  Route::post('/create_user', 'UserController@createUser')->middleware('can:users.create');
  Route::get('/edit_user/{id}', 'UserController@editUser')->middleware('can:users.edit');
  Route::get('/edit_sup_user/{id}', 'UserController@editSupuser')->middleware('can:users.edit');
  Route::post('/update_user/{id}', 'UserController@updateUser')->middleware('can:users.edit');
  Route::post('/create_sup_user', 'SupervisorController@createSupuser')->middleware('can:users.create');

  Route::get('/sup_users', 'SupervisorController@showSupusers')->middleware('can:consultar.supervisor');
  Route::get('/add_sup_user/{id}', 'SupervisorController@addSupuser')->middleware('can:users.show');
  Route::get('/show_vigs/{id}', 'SupervisorController@showVigs')->middleware('can:users.show');
  Route::get('/show_vigs_sup', 'SupervisorController@showVigssup')->middleware('can:consultar.personal');

  //reportar vigilador a rrhh
  Route::get('/show_vigs_sup/reports', 'SupervisorController@showReportvig')->middleware('can:reportar.personal');
  Route::get('/report_vig/{id}/{comentario_sup}', 'SupervisorController@reportVig')->middleware('can:reportar.personal');
  Route::get('/change_estate/{id}', 'SupervisorController@changeEstatesup')->middleware('can:reportar.personal');

  Route::get('/show_perso_ger/{id}', 'SupervisorController@showGerentePersonal')->middleware('can:personal.supervisores');
  Route::get('/only_vig/{id}', 'SupervisorController@showOnlyVig')->middleware('can:consultar.legajo');
  Route::get('/asignaciones/{id}', 'SupervisorController@showAsignacionesPersonal')->middleware('can:consultar.asignaciones');


  Route::get('/show_vigs_sup/reports/rrhh', 'RrhhController@showReportvig')->middleware('can:rrhh');
  Route::get('/resolve_report/{id}/{comentario_rrhh}', 'RrhhController@changeEstaterrhh')->middleware('can:rrhh');


 ?>
