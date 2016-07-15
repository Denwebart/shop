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
	Route::post('products/upload_image/', ['as' => 'admin.products.uploadImage', 'uses' => 'ProductsController@uploadImage']);
	Route::post('products/delete_image/', ['as' => 'admin.products.deleteImage', 'uses' => 'ProductsController@deleteImage']);

	Route::resource('pages', 'PagesController');

	Route::post('menus/get_menu_items', ['as' => 'admin.menus.getJsonMenuItems', 'uses' => 'MenusController@getJsonMenuItems']);
	Route::post('menus/rename', ['as' => 'admin.menus.rename', 'uses' => 'MenusController@rename']);
	Route::post('menus/delete', ['as' => 'admin.menus.delete', 'uses' => 'MenusController@delete']);
	Route::post('menus/position', ['as' => 'admin.menus.position', 'uses' => 'MenusController@changePosition']);
	Route::post('menus/add', ['as' => 'admin.menus.add', 'uses' => 'MenusController@add']);
	Route::get('menus/autocomplete', ['as' => 'admin.menus.autocomplete', 'uses' => 'MenusController@pagesAutocomplete']);

	Route::resource('shop_reviews', 'ReviewsController', ['except' => ['show']]);

	Route::resource('slider', 'SliderController');

	Route::resource('calls', 'RequestedCallsController', ['except' => ['create', 'store', 'show']]);

	Route::resource('reviews', 'ProductsReviewsController', ['except' => ['create', 'store', 'show']]);

	Route::resource('letters', 'LettersController', ['except' => ['create', 'store', 'edit', 'update']]);

	Route::resource('users', 'UsersController');

	Route::post('notifications/view/', ['as' => 'admin.notifications.view', 'uses' => 'NotificationsController@view']);

	Route::post('delivery/upload_image/', ['as' => 'admin.deliveryTypes.uploadImage', 'uses' => 'DeliveryTypesController@uploadImage']);
	Route::post('delivery/delete_image/', ['as' => 'admin.deliveryTypes.deleteImage', 'uses' => 'DeliveryTypesController@deleteImage']);
	Route::post('delivery/set_is_active/', ['as' => 'admin.deliveryTypes.setIsActive', 'uses' => 'DeliveryTypesController@setIsActive']);
	Route::post('delivery/set_value/', ['as' => 'admin.deliveryTypes.setValue', 'uses' => 'DeliveryTypesController@setValue']);
	Route::post('delivery/add/', ['as' => 'admin.deliveryTypes.add', 'uses' => 'DeliveryTypesController@add']);
	Route::post('delivery/remove/', ['as' => 'admin.deliveryTypes.remove', 'uses' => 'DeliveryTypesController@remove']);

	Route::post('work_with_us/upload_image/', ['as' => 'admin.workWithUs.uploadImage', 'uses' => 'WorkWithUsController@uploadImage']);
	Route::post('work_with_us/delete_image/', ['as' => 'admin.workWithUs.deleteImage', 'uses' => 'WorkWithUsController@deleteImage']);
	Route::post('work_with_us/set_is_active/', ['as' => 'admin.workWithUs.setIsActive', 'uses' => 'WorkWithUsController@setIsActive']);
	Route::post('work_with_us/set_value/', ['as' => 'admin.workWithUs.setValue', 'uses' => 'WorkWithUsController@setValue']);
	Route::post('work_with_us/add/', ['as' => 'admin.workWithUs.add', 'uses' => 'WorkWithUsController@add']);
	Route::post('work_with_us/remove/', ['as' => 'admin.workWithUs.remove', 'uses' => 'WorkWithUsController@remove']);

	Route::post('product_properties/add/', ['as' => 'admin.productProperties.add', 'uses' => 'ProductPropertiesController@add']);
	Route::get('product_properties/autocomplete', ['as' => 'admin.productProperties.autocomplete', 'uses' => 'ProductPropertiesController@autocomplete']);
	Route::post('product_properties/delete/', ['as' => 'admin.productProperties.delete', 'uses' => 'ProductPropertiesController@delete']);

	Route::post('settings/upload_image/', ['as' => 'admin.settings.uploadImage', 'uses' => 'SettingsController@uploadImage']);
	Route::post('settings/delete_image/', ['as' => 'admin.settings.deleteImage', 'uses' => 'SettingsController@deleteImage']);
	Route::post('settings/set_is_active/', ['as' => 'admin.settings.setIsActive', 'uses' => 'SettingsController@setIsActive']);
	Route::post('settings/set_value/', ['as' => 'admin.settings.setValue', 'uses' => 'SettingsController@setValue']);
	Route::get('settings', ['as' => 'admin.settings.index', 'uses' => 'SettingsController@general']);
	Route::get('settings/widgets', ['as' => 'admin.settings.widgets', 'uses' => 'SettingsController@widgets']);
	Route::get('settings/checkout', ['as' => 'admin.settings.checkout', 'uses' => 'SettingsController@checkout']);
	Route::get('settings/properties', ['as' => 'admin.settings.properties', 'uses' => 'SettingsController@properties']);

	Route::post('properties/add/', ['as' => 'admin.properties.add', 'uses' => 'PropertiesController@add']);
	Route::put('properties/set_property_value/', ['as' => 'admin.properties.setPropertyValue', 'uses' => 'PropertiesController@setPropertyValue']);
	Route::post('properties/remove/', ['as' => 'admin.properties.remove', 'uses' => 'PropertiesController@remove']);
	Route::post('properties/add_value/', ['as' => 'admin.properties.addValue', 'uses' => 'PropertiesController@addValue']);
	Route::post('properties/set_value_value/', ['as' => 'admin.properties.setValueValue', 'uses' => 'PropertiesController@setValueValue']);
	Route::post('properties/remove_value/', ['as' => 'admin.properties.removeValue', 'uses' => 'PropertiesController@removeValue']);

	Route::post('properties/upload_image/', ['as' => 'admin.properties.uploadImage', 'uses' => 'PropertiesController@uploadImage']);
	Route::post('properties/delete_image/', ['as' => 'admin.properties.deleteImage', 'uses' => 'PropertiesController@deleteImage']);

});