<?php
/**
 * Class Cart
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Cart;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class Cart extends BaseController
{
	public function show()
	{
		$products = Product::all();

		return view('widget.cart::index', compact('products'));
	}
	
	public function addToCart(Request $request)
	{
		if($request->ajax()) {

			$product = Product::find($request->get('id'));
			if($product) {
				// доделать добавление в корзину

				$products = [];
				
				return \Response::json([
					'success' => true,
					'cartHtml' => view('widget.cart::index')->with('products', $products)->render(),
				]);
			}

			return \Response::json([
				'success' => true,
				'message' => 'Произошла ошибка, товар не был добавлен в корзину.'
			]);
		}
	}
	
	public function removeFromCart(Request $request)
	{
		
	}
	
}