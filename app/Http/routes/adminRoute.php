<?php

Route::group(['middleware' => ['dependedetalleAdmin:admin', 'dependeLlamada:admin']], function () {

    Route::get('admin/details/{admin}/user', [

        'as' => 'detailsUserAdmin',
        'uses' => 'AdminUserController@detailsUser'
    ]);

    Route::resource('admin', 'AdminUserController');
});