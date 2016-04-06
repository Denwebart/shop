<?php
/**
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

Route::group(['module' => 'Admin', 'namespace' => 'Modules\Admin\Controllers'], function () {
	
	Route::get('admin', function () {
		return view('admin::index');
	});
});