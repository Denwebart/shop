<?php
//Route::pattern('parentOne', '/^(?!.*(_debugbar).*$)/xs');
//Route::pattern('categoryOne', '/^(?!.*(_debugbar).*$)/xs');


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/', 'SiteController@index');

Route::get('{parentOne}/{parentTwo}/{parentThree}/{page}', ['uses' => 'SiteController@pageFourLevel']);
Route::get('{parentOne}/{parentTwo}/{page}', ['uses' => 'SiteController@pageThreeLevel']);
Route::get('{parentOne}/{page}', ['uses' => 'SiteController@pageTwoLevel']);
Route::get('{page}', ['uses' => 'SiteController@pageOneLevel']);

Route::get('{categoryOne}/{categoryTwo}/{categoryThree}/{product}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productThreeLevel']);
Route::get('{categoryOne}/{categoryTwo}/{product}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productTwoLevel']);
Route::get('{categoryOne}/{product}', ['as' => 'product.productInfo', 'uses' => 'ProductController@productOneLevel']);