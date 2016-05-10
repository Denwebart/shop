<?php
//Route::pattern('parentOne', '/^(?!.*(_debugbar).*$)/xs');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/', 'SiteController@index');

Route::post('letter/send', ['as' => 'letter.send', 'uses' => 'SiteController@sendLetter']);

Route::get('cart', ['as' => 'cart.index', 'uses' => 'CartController@index']);
Route::post('cart/add', ['as' => 'cart.add', 'uses' => '\App\Widgets\Cart\Cart@addToCart']);
Route::post('cart/remove', ['as' => 'cart.remove', 'uses' => '\App\Widgets\Cart\Cart@removeFromCart']);

Route::get('sitemap.xml', ['as' => 'sitemapXml', 'uses' => 'SiteController@sitemapXml']);

Route::get('{parentOne}/{parentTwo}/{parentThree}/{page}', ['uses' => 'SiteController@pageFourLevel']);
Route::get('{parentOne}/{parentTwo}/{page}', ['uses' => 'SiteController@pageThreeLevel']);
Route::get('{parentOne}/{page}', ['uses' => 'SiteController@pageTwoLevel']);
Route::get('{page}', ['uses' => 'SiteController@pageOneLevel']);