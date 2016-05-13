<?php
/**
 * Class Cart
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Cart;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class Cart extends BaseController
{
	protected $cart = [
		'products' => [],
		'total_price' => 0,
	];

	public function show()
	{
		//доделать вывод товаров корзины
		$cart = $this->getCart();

		return view('widget.cart::cart', compact('cart'));
	}
	
	public function addToCart(Request $request)
	{
		if($request->ajax()) {

			$product = Product::find($request->get('id'));
			if(is_object($product)) {
				// доделать добавление в корзину
				$this->addProduct($request, $product, $request->get('quantity', 1));

				$cart = $this->getCart();
				
				return \Response::json([
					'success' => true,
					'cartHtml' => view('widget.cart::cart')->with('cart', $cart)->render(),
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
		if($request->ajax()) {

			$this->deleteProduct($request);

			$cart = $this->getCart();

			return \Response::json([
				'success' => true,
				'cartProductsHtml' => view('widget.cart::cartProducts')->with('cart', $cart)->render(),
				'productsCount' => count($cart['products']),
			]);
		}
	}

	public function getCart()
	{
		$cart = \Session::get('cart', $this->cart);

		foreach ($cart['products'] as $key => $item) {
			$productsIds[] = $item['product_id'];
		}

		if(isset($productsIds)) {
			$productModels = Product::whereIn('id', $productsIds)
				->whereIsPublished(1)
				->where('published_at', '<', Carbon::now())
				->with([
					'category' => function($q) {
						$q->select(['id', 'parent_id', 'alias', 'type']);
					}
				])->get(['id', 'category_id', 'alias', 'title', 'image', 'image_alt', 'price']);

			foreach($productModels as $productModel) {
				foreach($cart['products'] as $key => $item) {
					if($productModel->id == $item['product_id']) {
						$cart['products'][$key]['product'] = $productModel;
						$cart['total_price'] = $cart['total_price'] + $productModel->getPrice();
					}
				}
			}
		}

		return $cart;
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
		// доделать добавление с разными параметрами (цвет, размер)
		$cart = $request->session()->get('cart', $this->cart);

		$cart['products'][] = [
			'product_id' => $product->id,
			'quantity' => $quantity,
			'options' => [],
		];

		$request->session()->put('cart', $cart);
	}

	/**
	 * Delete product from cart session
	 *
	 * @param Request $request
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function deleteProduct(Request $request)
	{
		// доделать добавление с разными параметрами (цвет, размер)
		$cart = $request->session()->get('cart', $this->cart);
		unset($cart['products'][$request->get('key')]);

		$request->session()->put('cart', $cart);
	}
}