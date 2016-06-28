<?php
/**
 * Class NotificationsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests;

class NotificationsController extends Controller
{
	/**
	 * Show notification and remove
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function view(Request $request)
	{
		if(\Request::ajax()) {

			$notification = Notification::whereId($request->get('id'))
				->whereUserId(\Auth::user()->id)
				->first();

			if(Notification::destroy($request->get('id'))){
				return \Response::json([
					'success' => true,
					'message' => 'Уведомление успешно удалёно.',
					'notificationListHtml' => view('admin::notifications.list')->render(),
					'notificationModalHtml' => view('admin::notifications.modal')->with('notification', $notification)->render(),
					'notificationsCount' => count(\Auth::user()->notifications)
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка.'
				]);
			}
		}
	}
}
