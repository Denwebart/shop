<?php
/**
 * Class CartController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Cart;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Page;
use Illuminate\Http\Request;

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
	public function getCheckout()
	{
		$page = new Page();
		$page->title = 'Оформление заказа';

		return view('widget.cart::checkout', compact('page'));
	}

	/**
	 * Checkout
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function postCheckout(Request $request)
	{
		if($request->ajax()) {
			dd($request->all());

			$rules = [];

			$customer = Customer::wherePhone($request->get('phone'))->find();

		}
	}
}