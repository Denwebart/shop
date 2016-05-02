<?php
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/', 'SiteController@index');

//Route::get('admin/{one?}/{two?}/{three?}', ['as' => 'admin.index', 'uses' => '\App\Modules\Admin\Controllers\AdminController@index']);

//Route::get('{pages}', ['uses' => 'SiteController@page']);

//Route::get('{pages}/{pages}/{pages}', ['uses' => 'SiteController@page']);
//Route::get('{parentOne}/{pages}', ['uses' => 'SiteController@page']);
Route::get('{page}', ['uses' => 'SiteController@page']);

Route::get('{categoryOne?}/{categoryTwo?}/{categoryThree?}/{product}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productThreeLevel']);
Route::get('{categoryOne?}/{categoryTwo?}/{product}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productTwoLevel']);
Route::get('{categoryOne?}/{product}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productOneLevel']);