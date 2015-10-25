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


// Authentication routes...
Route::get('/', [
    'as' => 'login',
    'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('/', [
    'as' => 'login',
    'uses' => 'Auth\AuthController@postLogin'
]);


// Password reset link request routes...
Route::get('password/email', [
    'as' => 'urlpass',
    'uses' => 'Auth\PasswordController@getEmail'
]);
Route::post('password/email', [
    'as' => 'urlpass',
    'uses' => 'Auth\PasswordController@postEmail'
]);

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

//Cerrar secion
Route::get('logaut', [

    'as' => 'logaut',
    'uses' => 'Auth\AuthController@getLogout'

]);

//Pantalla de inicio Admin
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin', 'namespace' => 'Admin'], function () {

        Route::get('welcome', [

            'as' => 'welcomeAdmin',
            'uses' => 'AdminController@setting'
        ]);

        Route::get('details/{id}/user', [

            'as' => 'detailsUser',
            'uses' => 'AdminController@detailsUser'
        ]);

        Route::get('add/{id}/equipo', [

            'as' => 'foraddequipouser',
            'uses' => 'UserEquipoController@getquipouser'
        ]);
        Route::post('add/{id}/equipo', [

            'as' => 'addequipouser',
            'uses' => 'UserEquipoController@postquipouser'
        ]);

        Route::resource('add/user/equipos', 'UserEquipoController');
        Route::resource('user', 'AdminController');
        Route::resource('tipoequipo', 'tipoEquipoController');
        Route::resource('equipo', 'equipoController');


        Route::get('password/change', ['as' => 'changePassword', 'uses' => 'PasswordController@getPassword']);
        Route::post('password/change', ['as' => 'changePassword', 'uses' => 'PasswordController@postPassword']);

        Route::get('terminado/{id}', ['as' => 'terminar', 'uses' => 'AdminController@terminar']);

        Route::get('city', function () {

            $id = Input::get('state_id');
            $city = \App\citys::where('state_id','=',$id)->get();

            return Response::json($city);
        });

    });
});

//Email de confirmacion de registro
Route::group(['middleware' => 'RegisterConfirm'], function () {
    Route::get('confirmation/{token}', [
        'uses' => 'Admin\AdminController@getConfirmation',
        'as' => 'confirmation'
    ]);
});


