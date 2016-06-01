<?php
/**
 * Class CartController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Cart;

use App\Http\Controllers\Controller;
use App\Models\Page;

class CartController extends Controller
{
	public function index()
	{
		$page = new Page();
		$page->title = 'Корзина товаров';

		$cart = new Cart();
		$cart = $cart->getCart();

		return view('widget.cart::index', compact('page', 'cart'));
	}

	/**
	 * Checkout
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function checkout()
	{
		$page = new Page();
		$page->title = 'Оформление заказа';

		return view('widget.cart::checkout', compact('page'));
	}
}