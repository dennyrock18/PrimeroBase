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
use App\citys;
use App\User;
use Styde\Html\Facades\Alert;

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

//Email de confirmacion de registro
Route::group(['middleware' => 'RegisterConfirm'], function () {
    Route::get('confirmation/{token}', [
        'uses' => 'Admin\AdminController@getConfirmation',
        'as' => 'confirmation'
    ]);
});



//Pantalla de inicio Admin (Aplicacion)
Route::group(['middleware' => 'auth'], function () {


    Route::group(['middleware' => 'role:chofer,admin', 'namespace' => 'Admin'], function () {

        include __DIR__ . '/routes/choferAdminComunRoute.php';

    });


    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin', 'namespace' => 'Admin'], function () {

        include __DIR__ . '/routes/equiposRoute.php';
        include __DIR__ . '/routes/usersRoute.php';
        include __DIR__ . '/routes/adminRoute.php';
        include __DIR__ . '/routes/choferRoute.php';
        include __DIR__ . '/routes/pdfRoute.php';

    });
});




