<?php

Route::group(
    [],
    function () {
        Route::group(
            ['middleware' => 'auth'],
            function () {
                Route::get('/home', 'Front\ProductController@index')->name('admin.home');
                Route::get('/admin/menu', 'Front\MenusController@index')->name('admin.menu');
				Route::get('/admin/menu/items/{id}', 'Front\MenusController@items')->name('admin.menu.items');
                Route::get('/admin/token', array('uses' => 'Front\IndexController@token'))->name('token');
				Route::get('/admin/page', 'Front\PageController@index')->name('admin.page');
				Route::get('/admin/page/add', 'Front\PageController@add')->name('admin.page.add');
				Route::get('/admin/page/edit/{id}', 'Front\PageController@edit')->name('admin.page.edit');
				Route::get('/admin/product', 'Front\ProductController@index')->name('admin.product');
				Route::get('/admin/product/add', 'Front\ProductController@add')->name('admin.product.add');
				Route::get('/admin/product/edit/{id}', 'Front\ProductController@edit')->name('admin.product.edit');
				Route::get('/admin/product/images/{id}', 'Front\ProductController@images')->name('admin.product.images');
				Route::get('/admin/product-categories', 'Front\ProductController@categories')->name('admin.product-categories');
				Route::get('/admin/page/images/{id}', 'Front\PageController@images')->name('admin.page.images');
				Route::get('/admin/page-categories', 'Front\PageController@categories')->name('admin.page-categories');
				Route::get('/admin/discounts', 'Front\DiscountController@index')->name('admin.discounts');
				Route::get('/admin/orders', 'Front\OrderController@index')->name('admin.orders');
				Route::get('/admin/orders/details/{id}', 'Front\OrderController@details')->name('admin.orders.details');
            });

        Route::get('login', array('uses' => 'Front\IndexController@showLogin'))->name('login');
        Route::post('login', array('uses' => 'Front\IndexController@doLogin'));
        Route::get('logout', array('uses' => 'Front\IndexController@doLogout'))->name('logout');


    });
