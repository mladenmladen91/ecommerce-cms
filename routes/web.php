<?php

Route::get('/', function () {
    return redirect('login');
});
Route::get('/confirm/{token}', 'Customers\CustomersController@confirmUser');
Route::get('/getNewProducts', 'Products\ProductsController@getNewProducts');
Route::get('/pdfStyle', function () {
    return view("orderPDF");
});
Route::get('/test', 'Orders\OrdersController@renderPDF');

