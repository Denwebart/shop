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
	const STEP_CART = 'cart';
	const STEP_CHECKOUT = 'checkout';
	const STEP_PAYMENT = 'payment';

	protected static $steps = [
		self::STEP_CART => 'Корзина товаров',
		self::STEP_CHECKOUT => 'Оформление заказа',
		self::STEP_PAYMENT => 'Оплата заказа',
	];

	public function index(Request $request)
	{
		$page = new Page();
		$page->title = self::$steps[self::STEP_CART];

		$cart = new Cart();
		$cart = $cart->getCart();

		if($request->ajax()) {
			return \Response::json([
				'success' => true,
				'stepContent' => view('widget.cart::stepCart', compact('page', 'cart'))->render(),
			]);
		} else {
			return view('widget.cart::index', compact('page', 'cart'));
		}
	}

	/**
	 * Get step
	 *
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getStep(Request $request)
	{
		if($request->ajax()) {
			$step = $request->get('step');
			if(array_key_exists($step, self::$steps)) {
				$cart = new Cart();
				$cart = $cart->getCart();

				$page = new Page();
				$page->title = self::$steps[$step];

				return \Response::json([
					'success' => true,
					'stepContent' => view('widget.cart::step' . $step, compact('page', 'cart'))->render(),
				]);
			}

			return \Response::json([
				'success' => false,
			]);
		}
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

	/**
	 * Payment
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function postPayment(Request $request)
	{
		if($request->ajax()) {
			dd($request->all());

			$rules = [];

			$customer = Customer::wherePhone($request->get('phone'))->find();

		}
	}
}