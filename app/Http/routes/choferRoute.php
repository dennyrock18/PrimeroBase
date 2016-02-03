<?php

Route::group(['middleware' => 'dependeLlamada:chofer'], function () {

    Route::get('chofer/details/{chofer}/user', [

        'as' => 'detailsUserChofer',
        'uses' => 'ChoferController@detailsChofer'
    ]);

    Route::resource('chofer', 'ChoferController');
});