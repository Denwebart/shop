<?php
/**
 * Class CartController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Http\Controllers;

use App\Models\Page;
use App\Widgets\Cart\Cart;

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
}