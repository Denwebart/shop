<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

Route::group(['module' => 'Admin', 'prefix' => 'admin', 'middleware' => 'web', 'namespace' => 'Modules\Admin\Controllers'], function () {
	
	Route::get('/', ['as' => 'admin.main', 'uses' => 'AdminController@index']);
	
});