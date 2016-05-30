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

	Route::resource('menus', 'MenusController');

	Route::resource('shop_reviews', 'ReviewsController', ['except' => ['show']]);

	Route::resource('slider', 'SliderController');

	Route::resource('calls', 'RequestedCallsController', ['except' => ['create', 'store', 'show']]);

	Route::resource('reviews', 'ProductsReviewsController', ['except' => ['create', 'store', 'show']]);

	Route::resource('letters', 'LettersController', ['except' => ['create', 'store', 'edit', 'update']]);

	Route::resource('users', 'UsersController');

	Route::post('settings/upload_image/', ['as' => 'admin.settings.uploadImage', 'uses' => 'SettingsController@uploadImage']);
	Route::post('settings/delete_image/', ['as' => 'admin.settings.deleteImage', 'uses' => 'SettingsController@deleteImage']);
	Route::post('settings/set_is_active/', ['as' => 'admin.settings.setIsActive', 'uses' => 'SettingsController@setIsActive']);
	Route::put('settings/set_value/', ['as' => 'admin.settings.setValue', 'uses' => 'SettingsController@setValue']);
	Route::resource('settings', 'SettingsController', ['except' => ['create', 'store', 'destroy', 'show']]);

	Route::post('menus/get_menu_items', ['as' => 'admin.menus.getJsonMenuItems', 'uses' => 'MenusController@getJsonMenuItems']);
	Route::post('menus/rename', ['as' => 'admin.menus.rename', 'uses' => 'MenusController@rename']);
	Route::post('menus/delete', ['as' => 'admin.menus.delete', 'uses' => 'MenusController@delete']);
});