<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

Route::group(['module' => 'Admin', 'prefix' => 'admin', 'middleware' => 'web', 'namespace' => 'App\Modules\Admin\Controllers'], function () {
	
	Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
	Route::resource('orders', 'OrdersController');
	Route::post('orders/get_statuses', ['as' => 'admin.orders.getJsonOrderStatues', 'uses' => 'OrdersController@getJsonOrderStatues']);
	Route::post('orders/{orders}/set_status', ['as' => 'admin.orders.setOrderStatus', 'uses' => 'OrdersController@setOrderStatus']);
	Route::post('orders/get_payment_statuses', ['as' => 'admin.orders.getJsonPaymentStatues', 'uses' => 'OrdersController@getJsonPaymentStatues']);
	Route::post('orders/{orders}/set_payment_status', ['as' => 'admin.orders.setPaymentStatus', 'uses' => 'OrdersController@setPaymentStatus']);
	Route::resource('products', 'ProductsController');
	Route::resource('pages', 'PagesController');
	Route::resource('slider', 'SliderController');
	Route::resource('calls', 'RequestedCallsController', ['except' => ['create', 'store', 'show']]);
	Route::resource('reviews', 'ProductsReviewsController', ['except' => ['create', 'store', 'show']]);
	Route::resource('letters', 'LettersController', ['except' => ['create', 'store', 'edit', 'update']]);
	Route::resource('users', 'UsersController');
	Route::resource('settings', 'SettingsController', ['except' => [
		'create', 'store', 'destroy', 'show'
	]]);

});