<?php

Route::get('add/{id}/equipo', [

'as' => 'foraddequipouser',
'uses' => 'UserEquipoController@getquipouser'
]);
Route::post('add/{id}/equipo', [

'as' => 'addequipouser',
'uses' => 'UserEquipoController@postquipouser'
]);

Route::post('delete', [

    'as' => 'deletemultiplo',
    'uses' => 'UserEquipoController@deleteMultiplo'
]);

Route::resource('add/user/equipos', 'UserEquipoController');
Route::resource('tipoequipo', 'tipoEquipoController');
Route::resource('equipo', 'equipoController');

Route::get('equipo/{id}/terminado', ['as' => 'terminar', 'uses' => 'equipoController@terminar']);

Route::get('equipos/pdf', [
    'as' => 'pfdequipos',
    'uses' => 'equipoController@invoice'
]);

Route::get('equipos/user/{id}/pdf', [
    'as' => 'pfduserequipos',
    'uses' => 'UserEquipoController@invoice'
]);