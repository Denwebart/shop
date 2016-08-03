<?php
/**
 * Class OrdersController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class OrdersController extends Controller
{
	public function __construct(Badge $badge)
	{
		parent::__construct($badge);
		
		$this->middleware('admin', ['only' => ['destroy']]);
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $orders = $this->getOrders();

        return view('admin::orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $order = Order::whereId($id)
		    ->with('groupedOrderProducts', 'groupedOrderProducts.product')
		    ->first();

	    return view('admin::orders.show', compact('order'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$order = new Order();

		return view('admin::orders.create', compact('order'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		var_dump('создание нового заказа');
		dd(Input::all());
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $order = Order::findOrFail($id);

	    return view('admin::orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    var_dump('редактирование заказа с id '. $id);
	    dd(Input::all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    if(\Request::ajax()) {

		    if(!Auth::user()->isAdmin()) {
			    return \Response::json([
				    'success' => false,
				    'message' => 'Заказ не удалён. У вас недостаточно прав.',
			    ]);
		    }

		    $order = Order::find($id);
		    $order->delete();

		    $orders = $this->getOrders();

		    return \Response::json([
			    'success' => true,
			    'message' => 'Заказ успешно удалён.',
			    'itemsCount'      => view('parts.count')->with('models', $orders)->render(),
			    'itemsPagination' => view('parts.pagination')->with('models', $orders)->render(),
			    'itemsTable'      => view('admin::orders.table')->with('orders', $orders)->render(),
		    ]);
	    }
    }

	/**
	 * Get order statuses array in Json format
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getJsonOrderStatues(Request $request)
	{
		if($request->ajax()) {
			$statusesArray = [];
			foreach(Order::$statuses as $key => $status) {
				$statusesArray[] = [
					'value' => $key,
					'text' => $status,
					'class' => Order::$statusesClass[$key]
				];
			}
			return \Response::json($statusesArray);
		}
	}

	/**
	 * Change order status
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setOrderStatus(Request $request, $id)
	{
		if($request->ajax()) {
			$order = Order::findOrFail($id);
			$order->status = $request->get('value');
			if(!$order->user) {
				$order->user_id = Auth::user()->id;
			}
			$order->save();

			return \Response::json([
				'success' => true,
				'message' => 'Статус заказа изменён.'
			]);
		}
	}

	/**
	 * Get payment statuses array in Json format
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getJsonPaymentStatues(Request $request)
	{
		if($request->ajax()) {
			$statusesArray = [];
			foreach(Order::$paymentStatuses as $key => $status) {
				$statusesArray[] = [
					'value' => $key,
					'text' => $status,
					'class' => Order::$paymentStatusesClass[$key]
				];
			}
			return \Response::json($statusesArray);
		}
	}

	/**
	 * Change payment status of order
	 *
	 * @param Request $request
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setPaymentStatus(Request $request, $id)
	{
		if($request->ajax()) {
			$order = Order::findOrFail($id);
			$order->payment_status= $request->get('value');
			if(!$order->user) {
				$order->user_id = Auth::user()->id;
			}
			$order->save();

			return \Response::json([
				'success' => true,
				'message' => 'Статус оплаты изменён.'
			]);
		}
	}
	
	/**
	 * Get list of orders
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getOrders()
	{
		return Order::with(['user', 'customer', 'groupedProducts'])
			->orderBy('created_at', 'DESC')
			->paginate(20);
	}
}
