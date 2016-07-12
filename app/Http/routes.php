<?php
//Route::pattern('parentOne', '/^(?!.*(_debugbar).*$)/xs');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/', 'SiteController@index');

Route::get('currency/change', ['as' => 'currency.change', 'uses' => 'CurrencyController@change']);

Route::post('letter/send', ['as' => 'letter.send', 'uses' => 'SiteController@sendLetter']);

Route::post('call/request', ['as' => 'call.request', 'uses' => 'SiteController@requestCall']);

Route::post('comment/add/{product_id}', ['as' => 'comment.add', 'uses' => 'CommentsController@add']);
Route::post('comment/vote', ['as' => 'comment.vote', 'uses' => 'CommentsController@vote']);

Route::post('viewed/add', ['as' => 'viewed.add', 'uses' => '\App\Widgets\Viewed\Viewed@add']);

Route::post('remember_cookie', ['as' => 'remember.cookie', 'uses' => 'SiteController@rememberInCookie']);

Route::get('cart', ['as' => 'cart.index', 'uses' => '\App\Widgets\Cart\CartController@index']);
Route::post('cart/step', ['as' => 'cart.getStep', 'uses' => '\App\Widgets\Cart\CartController@getStep']);
Route::post('cart/checkout', ['as' => 'cart.postCheckout', 'uses' => '\App\Widgets\Cart\CartController@postCheckout']);
Route::post('cart/payment', ['as' => 'cart.postPayment', 'uses' => '\App\Widgets\Cart\CartController@postPayment']);
Route::post('cart/add', ['as' => 'cart.add', 'uses' => '\App\Widgets\Cart\Cart@addToCart']);
Route::post('cart/remove', ['as' => 'cart.remove', 'uses' => '\App\Widgets\Cart\Cart@removeFromCart']);
Route::post('cart/quantity', ['as' => 'cart.quantity', 'uses' => '\App\Widgets\Cart\Cart@changeQuantity']);
Route::get('cart/success', ['as' => 'cart.success', 'uses' => '\App\Widgets\Cart\CartController@success']);

Route::get('wishlist', ['as' => 'wishlist.index', 'uses' => '\App\Widgets\Wishlist\WishlistController@index']);
Route::post('wishlist/add', ['as' => 'wishlist.add', 'uses' => '\App\Widgets\Wishlist\Wishlist@addToWishlist']);
Route::post('wishlist/remove_all', ['as' => 'wishlist.removeAll', 'uses' => '\App\Widgets\Wishlist\Wishlist@removeAll']);
Route::post('wishlist/remove', ['as' => 'wishlist.remove', 'uses' => '\App\Widgets\Wishlist\Wishlist@removeFromWishlist']);

Route::get('sitemap.xml', ['as' => 'sitemapXml', 'uses' => 'SiteController@sitemapXml']);

Route::get('{parentOne}/{parentTwo}/{parentThree}/{page}', ['uses' => 'SiteController@pageFourLevel']);
Route::get('{parentOne}/{parentTwo}/{page}', ['uses' => 'SiteController@pageThreeLevel']);
Route::get('{parentOne}/{page}', ['uses' => 'SiteController@pageTwoLevel']);
Route::get('{page}', ['uses' => 'SiteController@pageOneLevel']);