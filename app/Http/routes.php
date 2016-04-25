<?php

Route::auth();

Route::get('/', 'SiteController@index');
Route::get('{products}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productInfo']);