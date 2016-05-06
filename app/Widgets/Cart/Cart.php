<?php
/**
 * Class Cart
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Cart;


use App\Models\Product;

class Cart
{
	public function show()
	{
		$products = Product::all();
//		$products = [];

		return view('widget.cart::index', compact('products'));
	}
	
}