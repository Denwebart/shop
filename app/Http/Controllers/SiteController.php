<?php
/**
 * Class SiteController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Http\Controllers;


use App\Widgets\Slider\Slider;

class SiteController extends Controller
{
	/**
	 * Main page
	 * 
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function index() {

		$slider = new Slider();

		return view('index', compact('slider'));
	}
}