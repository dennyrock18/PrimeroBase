<?php

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

Route::get('city', function () {
    $id = Input::get('state_id');
    $city = citys::where('state_id', '=', $id)
        ->get()
        ->toArray();

    array_unshift($city, ['id' => '', 'city' => 'Select value']);

    return Response::json($city);
});