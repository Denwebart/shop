<?php
//Route::pattern('parentOne', '/^(?!.*(_debugbar).*$)/xs');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/', 'SiteController@index');

Route::get('{parentOne}/{parentTwo}/{parentThree}/{page}', ['uses' => 'SiteController@pageFourLevel']);
Route::get('{parentOne}/{parentTwo}/{page}', ['uses' => 'SiteController@pageThreeLevel']);
Route::get('{parentOne}/{page}', ['uses' => 'SiteController@pageTwoLevel']);
Route::get('{page}', ['uses' => 'SiteController@pageOneLevel']);