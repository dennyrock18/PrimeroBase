<?php

Route::group(['middleware' => ['dependedetalleAdmin:admin', 'dependeLlamada:admin']], function () {

    Route::get('logs', [

        'as' => 'logs',
        'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index'

    ]);

    Route::get('admin/details/{admin}/user', [

        'as' => 'detailsUserAdmin',
        'uses' => 'AdminUserController@detailsUser'
    ]);

    Route::resource('admin', 'AdminUserController');
});