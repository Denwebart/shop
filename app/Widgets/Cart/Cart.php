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

		return view('widget.cart::widget.cart', compact('cart'));
	}
	
	public function addToCart(Request $request)
	{
		if($request->ajax()) {

			$product = Product::find($request->get('id'));
			if(is_object($product)) {
				// доделать добавление с доп. характеристиками
				
				$options = $request->get('options');
				if((count($product->propertyColor) > 1 && !isset($options['color'])) || (count($product->propertySize) > 1 && !isset($options['size']))) {
					if(count($product->propertyColor) > 1 && !isset($options['color'])) {
						$errors['color'] = 'Выберите цвет.';
					}
					if(count($product->propertySize) > 1 && !isset($options['size'])) {
						$errors['size'] = 'Выберите размер.';
					}
					return \Response::json([
						'selectProperties' => true,
						'message' => 'Выберите обязательные характеристики товара.',
						'modalContent' => view('widget.cart::widget.modalSelect', compact('product'))->render(),
						'errors' => isset($errors) ? $errors : []
					]);
				}
				
				$this->addProduct($request, $product, $request->get('quantity', 1));

				$cart = $this->getCart();
				
				return \Response::json([
					'success' => true,
					'message' => 'Продукт успешно добавлен в корзину!',
					'cartHtml' => view('widget.cart::widget.cartButton', compact('cart'))->render(),
					'modalContent' => view('widget.cart::widget.modalSuccess', compact('product'))->render(),
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
				'productsWidgetHtml' => view('widget.cart::widget.productsWidget')->with('cart', $cart)->render(),
				'productsTableHtml' => view('widget.cart::checkout.productsTable')->with('cart', $cart)->render(),
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
				])->get(['id', 'category_id', 'alias', 'title', 'image', 'image_alt', 'price', 'vendor_code']);

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
		if(!isset($options['color']) && count($product->propertyColor) == 1 && is_object($product->propertyColor()->first())) {
			$options['color'] = $product->propertyColor()->first()->value;
		}
		if(!isset($options['size']) && count($product->propertySize) == 1 && is_object($product->propertySize()->first())) {
			$options['size'] = $product->propertySize()->first()->value;
		}

		foreach($cart['products'] as $key => $cartProduct) {
			if($cartProduct['product_id'] == $product->id && $cartProduct['options'] == $options) {
				$cart['products'][$key]['quantity'] = $cartProduct['quantity'] + $quantity;
				$request->session()->put('cart', $cart);
				return true;
			}
		}

		$cart['products'][] = [
			'product_id' => $product->id,
			'quantity' => $quantity,
			'options' => $options,
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
		array_splice($cart['products'], $request->get('key'), 1);

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
			'productsWidgetHtml' => view('widget.cart::widget.productsWidget')->with('cart', $cart)->render(),
			'productsTableHtml' => view('widget.cart::checkout.productsTable')->with('cart', $cart)->render(),
			'productsCount' => $cart['count'],
		]);
	}
}