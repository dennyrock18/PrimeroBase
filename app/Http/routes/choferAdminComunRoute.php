<?php

use App\delivery;
use App\User;

Route::get('welcome', [

    'as' => 'welcomeAdmin',
    'uses' => 'AdminController@setting'
]);

//delivery
Route::get('delivery/realizados', [

    'as' => 'deliveryRealizados',
    'uses' => 'DeliveriController@deliveryR'
]);

Route::get('subir/foto', [

    'as' => 'subirFoto',
    'uses' => 'AdminController@subirFoto'
]);

Route::post('subir/foto', [

    'as' => 'subirFoto',
    'uses' => 'AdminController@storeFoto'
]);

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
    return redirect()->route('delivery.index'/*, compact('$users')*/);
});

