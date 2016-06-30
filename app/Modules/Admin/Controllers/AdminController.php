<?php
/**
 * Class AdminController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Http\Requests;
use App\Models\Order;
use App\Models\RequestedCall;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$orders = Order::select(['id', 'customer_id', 'total_price', 'status', 'created_at', 'paid_at'])
			->with('customer')
			->orderBy('created_at', 'DESC')
			->limit(10)
			->get();

		$calls = RequestedCall::select(['id', 'user_id', 'name', 'phone', 'status', 'created_at'])
			->with('user')
			->orderBy('created_at', 'DESC')
			->limit(5)
			->get();

		return view('admin::admin.index', compact('calls', 'orders'));
	}
}