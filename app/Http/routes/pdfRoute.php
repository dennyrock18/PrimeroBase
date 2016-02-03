<?php

Route::resource('list/reporte/pdf', 'PdfController');

Route::get('download/{archivo}', [
    'as' => 'downloadPdf',
    'uses' => 'PdfController@download'
]);