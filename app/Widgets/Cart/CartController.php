<?php
/**
 * Class CartController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Cart;

use App\Helpers\LiqPay;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Page;
use Illuminate\Http\Request;

class CartController extends Controller
{
	const STEP_CART = 'cart';
	const STEP_CHECKOUT = 'checkout';
	const STEP_PAYMENT = 'payment';
	const STEP_SUCCESS = 'success';

	protected static $steps = [
		self::STEP_CART => 'Корзина товаров',
		self::STEP_CHECKOUT => 'Оформление заказа',
		self::STEP_PAYMENT => 'Оплата заказа',
		self::STEP_SUCCESS => 'Заказ оформлен',
	];

	protected $publicKey = 'i99260556035';
	protected $privateKey = 'C4y9VYr8b7BX66jfGWHt4xufmbF1KJUCjPj6zQdC';

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

	public function success(Request $request)
	{
		$page = new Page();
		$page->title = 'Success!';

		if($request->ajax()) {
			return \Response::json([
				'success' => true,
				'stepContent' => view('widget.cart::success', compact('page'))->render(),
			]);
		} else {
			return view('widget.cart::success', compact('page'));
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
					'stepContent' => view('widget.cart::step' . ucfirst($step), compact('page', 'cart'))->render(),
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
			dd('sdf');

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
			$cart = new Cart();
			$cart = $cart->getCart();

			$totalPrice = $cart['total_price'];

			// доделать создание заказа в табл. Order
			$orderId = rand(10000, 99999);

			// доделать - вынести переменные publicKey privateKey
			$liqpay = new LiqPay($this->publicKey, $this->privateKey);

			$data['form'] = $liqpay->cnb_form([
				'version'        => '3',
				'public_key'     => $this->publicKey,
				'action'         => 'pay',
				'amount'         => $totalPrice,
				'currency'       => 'UAH',
				'description'    => 'Test LiqPay payment',
				'order_id'       => $orderId,
				'language'       => 'ru',
				'sandbox'        => 1,
				'result_url'     => route('cart.success'),
			]);

			// доделать user_email
			$data['user_email'] = 'annywebart@yandex.ua';
			$data['sum'] = $totalPrice;

			$page = new Page();
			$page->title = 'Оплата заказа';

			return \Response::json([
				'success' => true,
				'paymentFormHtml' => view('widget.cart::paymentForm', compact('data', 'page'))->render(),
			]);
		}
	}
}