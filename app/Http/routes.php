<?php

Route::auth();

Route::get('/', 'SiteController@index');

Route::get('admin', ['as' => 'admin.index', 'uses' => 'AdminController@index']);

Route::get('{products}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productInfo']);