<?php
Route::group(
    ['prefix' => 'products/'],
    function () {
        Route::group(
            ['middleware' => 'auth:api'],
            function () {
                Route::post('/addProduct', 'Products\ProductsController@addProduct');
                Route::post('/deleteProduct', 'Products\ProductsController@deleteProduct');
                Route::post('/updateProduct', 'Products\ProductsController@updateProduct');
                Route::post('/updateSpecification', 'Products\ProductsController@updateSpecification');
                Route::post('/deleteSpecification', 'Products\ProductsController@deleteSpecification');
                Route::post('/addImages', 'Products\ProductsController@addImages');
                Route::post('/deleteImage', 'Products\ProductsController@deleteImage');
			    Route::post('/sortImages', 'Products\ProductsController@sortImages');	
                Route::post('/sortProducts', 'Products\ProductsController@sortProducts');
                Route::post('/sortNewProducts', 'Products\ProductsController@sortNewProducts');
				Route::post('/getAllChildrenCategories', 'Products\ProductsController@getAllChildrenCategories');
                Route::post('/toggleSpecialOffer', 'Products\ProductsController@toggleSpecialOffer');
            });
        Route::post('/addProductCategory', 'Products\ProductsController@addProductCategory');
        Route::post('/getAllProductsForSorting', 'Products\ProductsController@getAllProductsForSorting');
        Route::post('/getAllProducts', 'Products\ProductsController@getAllProducts');
        Route::post('/getProduct', 'Products\ProductsController@getProduct');
        Route::post('/getAllProductsRabat', 'Products\ProductsController@getAllProductsRabat');
		Route::post('/listImages', 'Products\ProductsController@listImages');
		Route::post('/getSearchProducts', 'Products\ProductsController@getSearchProducts');
    });
