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

//Pantalla de inicio Admin
Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'role:chofer,admin', 'namespace' => 'Admin'], function () {

        Route::get('welcome', [

            'as' => 'welcomeAdmin',
            'uses' => 'AdminController@setting'
        ]);

        //delivery
        Route::resource('delivery', 'DeliveriController');

        Route::get('password/change', ['as' => 'changePassword', 'uses' => 'PasswordController@getPassword']);
        Route::post('password/change', ['as' => 'changePassword', 'uses' => 'PasswordController@postPassword']);


        Route::group(['middleware' => 'delivery'], function () {

            Route::get('mapa/{user}/user', [

                'as' => 'mapa',
                'uses' => 'DeliveriController@mapa'
            ]);

            Route::put('delivery/fecha-entrega/{user}', [

                'as' => 'fechaEntregaDelivery',
                'uses' => 'DeliveriController@fechaEntregaDelivery'
            ]);
        });

        Route::get('cancelar/delivery', function () {
            $id = Input::get('id_user');

            //dd($id);

            $user = User::Find($id);
            $user->fecha_entrega = null;
            $user->save();

            $users = User::where('fecha_entrega','<>', 'null')->paginate(2);

            //Alert::message('Se ha eliminado el Usuario: ' . $user->fullname . ' del listado de deliveris', 'success');
            return redirect()->route('delivery.index');
        });

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin', 'namespace' => 'Admin'], function () {

        Route::get('add/{id}/equipo', [

            'as' => 'foraddequipouser',
            'uses' => 'UserEquipoController@getquipouser'
        ]);
        Route::post('add/{id}/equipo', [

            'as' => 'addequipouser',
            'uses' => 'UserEquipoController@postquipouser'
        ]);

        Route::resource('add/user/equipos', 'UserEquipoController');

        //Restriccion a traves del navegador********************************
        Route::group(['middleware' => 'dependeLlamada:user'], function () {

            Route::get('user/details/{user}/user', [

                'as' => 'detailsUser',
                'uses' => 'AdminController@detailsUser'
            ]);

            Route::put('user/fecha-entrega/{user}', [

                'as' => 'fechaEntrega',
                'uses' => 'AdminController@fechaEntrega'
            ]);

            Route::resource('user', 'AdminController');
        });
        //***********************************************************************

        Route::resource('tipoequipo', 'tipoEquipoController');
        Route::resource('equipo', 'equipoController');


        //Restriccion a traves del navegador********************************
        /* Route::group(['middleware' => 'dependedetalleAdmin:admin'], function () {

         });*/


        Route::group(['middleware' => ['dependedetalleAdmin:admin', 'dependeLlamada:admin']], function () {

            Route::get('admin/details/{admin}/user', [

                'as' => 'detailsUserAdmin',
                'uses' => 'AdminUserController@detailsUser'
            ]);

            Route::resource('admin', 'AdminUserController');
        });


        Route::group(['middleware' => 'dependeLlamada:chofer'], function () {

            Route::get('chofer/details/{chofer}/user', [

                'as' => 'detailsUserChofer',
                'uses' => 'ChoferController@detailsChofer'
            ]);

            Route::resource('chofer', 'ChoferController');
        });
        //***********************************************************************


        Route::resource('list/reporte/pdf', 'PdfController');

        /* Route::get('password/change', ['as' => 'changePassword', 'uses' => 'PasswordController@getPassword']);
         Route::post('password/change', ['as' => 'changePassword', 'uses' => 'PasswordController@postPassword']);*/


        Route::get('equipo/{id}/terminado', ['as' => 'terminar', 'uses' => 'equipoController@terminar']);

        Route::get('equipos/pdf', [
            'as' => 'pfdequipos',
            'uses' => 'equipoController@invoice'
        ]);

        Route::get('equipos/user/{id}/pdf', [
            'as' => 'pfduserequipos',
            'uses' => 'UserEquipoController@invoice'
        ]);

        Route::get('download/{archivo}', [
            'as' => 'downloadPdf',
            'uses' => 'PdfController@download'
        ]);

        Route::get('city', function () {
            $id = Input::get('state_id');
            $city = citys::where('state_id', '=', $id)
                ->get()
                ->toArray();

            array_unshift($city, ['id' => '', 'city' => 'Select value']);

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


