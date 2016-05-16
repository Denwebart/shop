<?php
//Route::pattern('parentOne', '/^(?!.*(_debugbar).*$)/xs');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/', 'SiteController@index');

Route::post('letter/send', ['as' => 'letter.send', 'uses' => 'SiteController@sendLetter']);

Route::post('comment/add/{product_id}', ['as' => 'comment.add', 'uses' => 'CommentsController@add']);
Route::post('comment/vote', ['as' => 'comment.vote', 'uses' => 'CommentsController@vote']);

Route::get('cart', ['as' => 'cart.index', 'uses' => 'CartController@index']);
Route::post('cart/add', ['as' => 'cart.add', 'uses' => '\App\Widgets\Cart\Cart@addToCart']);
Route::post('cart/remove', ['as' => 'cart.remove', 'uses' => '\App\Widgets\Cart\Cart@removeFromCart']);

Route::get('wishlist', ['as' => 'wishlist.index', 'uses' => 'WishlistController@index']);
Route::post('wishlist/add', ['as' => 'wishlist.add', 'uses' => '\App\Widgets\Wishlist\Wishlist@addToWishlist']);
Route::post('wishlist/remove', ['as' => 'wishlist.remove', 'uses' => '\App\Widgets\Wishlist\Wishlist@removeFromWishlist']);

Route::get('sitemap.xml', ['as' => 'sitemapXml', 'uses' => 'SiteController@sitemapXml']);

Route::get('{parentOne}/{parentTwo}/{parentThree}/{page}', ['uses' => 'SiteController@pageFourLevel']);
Route::get('{parentOne}/{parentTwo}/{page}', ['uses' => 'SiteController@pageThreeLevel']);
Route::get('{parentOne}/{page}', ['uses' => 'SiteController@pageTwoLevel']);
Route::get('{page}', ['uses' => 'SiteController@pageOneLevel']);