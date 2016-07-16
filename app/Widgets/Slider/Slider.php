<?php
/**
 * Class Slider
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Slider;


class Slider
{
	public function show()
	{
		return \Cache::rememberForever('widgets.slider', function() {
			$items = \App\Models\Slider::whereIsPublished(1)->get();
			return view('widget.slider::index', compact('items'))->render();
		});
	}
}