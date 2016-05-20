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
		'count' => 0,
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
					'message' => 'Продукт успешно добавлен в корзину!',
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
				'cartProductsHtml' => view('widget.cart::products')->with('cart', $cart)->render(),
				'productsCount' => $cart['count'],
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
				->where('published_at', '<=', Carbon::now())
				->with([
					'category' => function($q) {
						$q->select(['id', 'parent_id', 'alias', 'type']);
					}
				])->get(['id', 'category_id', 'alias', 'title', 'image', 'image_alt', 'price']);

			foreach($productModels as $productModel) {
				foreach($cart['products'] as $key => $item) {
					if($productModel->id == $item['product_id']) {
						$cart['products'][$key]['product'] = $productModel;
						$cart['total_price'] = $cart['total_price'] + ($productModel->getPrice() * $item['quantity']);
						$cart['count'] = $cart['count'] + $item['quantity'];
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
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function addProduct(Request $request, $product, $quantity = 1)
	{
		// доделать добавление с разными параметрами (цвет, размер)
		$cart = $request->session()->get('cart', $this->cart);

		$options = $request->has('options') ? $request->get('options') : [];

		foreach($cart['products'] as $key => $cartProduct) {
			if($cartProduct['product_id'] == $product->id && $cartProduct['options'] == $options) {
				$cart['products'][$key]['quantity'] = $cartProduct['quantity'] + 1;
				$request->session()->put('cart', $cart);
				return true;
			}
		}

		$cart['products'][] = [
			'product_id' => $product->id,
			'quantity' => $quantity,
			'options' => [],
			'product' => [],
		];
		$request->session()->put('cart', $cart);
		return true;
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

	/**
	 * Change product quantity in cart session
	 *
	 * @param Request $request
	 * @return bool|\Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function changeQuantity(Request $request)
	{
		$cart = $request->session()->get('cart', $this->cart);
		
		foreach($cart['products'] as $key => $cartProduct) {
			if($key == $request->get('key')) {
				$cart['products'][$key]['quantity'] = $request->get('quantity');
			}
		}

		$request->session()->put('cart', $cart);

		$cart = $this->getCart();

		return \Response::json([
			'success' => true,
			'cartProductsHtml' => view('widget.cart::products')->with('cart', $cart)->render(),
			'productsCount' => $cart['count'],
		]);
	}
}