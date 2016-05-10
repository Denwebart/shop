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
		//доделать вывод товаров корзины
		$products = Product::with(['category', 'category.parent'])->get();

		return view('widget.cart::cart', compact('products'));
	}
	
	public function addToCart(Request $request)
	{
		if($request->ajax()) {

			$product = Product::find($request->get('id'));
			if(is_object($product)) {
				// доделать добавление в корзину
				$this->addProduct($request, $product, $request->get('quantity', 1));

				$products = $this->getProducts();
				
				return \Response::json([
					'success' => true,
					'cartHtml' => view('widget.cart::cart')->with('products', $products)->render(),
				]);
			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка, товар не был добавлен в корзину.'
			]);
		}
	}
	
	public function removeFromCart(Request $request)
	{
		// доделать
		
	}


	/**
	 * Add product to cart with session
	 *
	 * @param Request $request
	 * @param $product
	 * @param int $quantity
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function addProduct(Request $request, $product, $quantity = 1)
	{
		$cartProducts = $request->session()->get('cart', []);
		$cartProducts[] = [
			'product_id' => $product->id,
			'quantity' => $quantity,
		];
		$request->session()->put('cart', $cartProducts);
	}


	protected function getProducts()
	{
		return [];
	}
}