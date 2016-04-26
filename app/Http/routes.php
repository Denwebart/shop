<?php
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/', 'SiteController@index');
Route::get('{products}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productInfo']);