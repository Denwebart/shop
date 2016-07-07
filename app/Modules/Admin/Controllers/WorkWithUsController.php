<?php
/**
 * Class WorkWithUsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\WorkWithUs;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WorkWithUsController extends Controller
{
	/**
	 * Add new
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function add(Request $request)
	{
		if($request->ajax()) {
			$data = $request->all();

			$validator = \Validator::make($data, WorkWithUs::rules());

			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Значение не добавлено. Исправьте ошибки.'
				]);
			} else {
				$item = WorkWithUs::create($data);
				$item->setImage($request);
				$item->save();

				return \Response::json([
					'success' => true,
					'message' => 'Значение добавлено.',
					'itemHtml' => view('admin::workWithUs.item', compact('item'))->render(),
				]);
			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка.'
			]);
		}
	}

	/**
	 * Delete item
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function remove(Request $request)
	{
		if($request->ajax()) {

			if (WorkWithUs::destroy($request->get('id')))
			{
				return \Response::json([
					'success' => true,
					'message' => 'Значение успешно удалено.',
				]);
			} 

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка. Значение не удалено.',
			]);
		}
	}

	/**
	 * Set value
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setValue(Request $request)
	{
		if($request->ajax()) {
			$item = WorkWithUs::findOrFail($request->get('pk'));

			$field = $request->get('name');
			if($item && $field) {
				$data = $request->all();
				$data[$field] = trim($request->get('value')) ? trim($request->get('value')) : null;

				$validator = \Validator::make($data, $item->getRules($field));

				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first('value'),
						'message' => 'Значение не изменено. Исправьте ошибки.'
					]);
				} else {
					$item->$field = $data['value'];
					$item->save();

					return \Response::json([
						'success' => true,
						'message' => 'Значение изменено.'
					]);
				}
			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка.'
			]);
		}
	}

	/**
	 * Set active status
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function setIsActive(Request $request)
	{
		if($request->ajax()) {
			$item = WorkWithUs::findOrFail($request->get('id'));

			if($item) {
				$item->is_published = $request->get('value');
				if($item->is_published) {
					$item->published_at = Carbon::now();
				} else {
					$item->published_at = null;
				}
				$item->save();

				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . WorkWithUs::$is_published[$item->is_published] . '".'
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка.'
				]);
			}
		}
	}

	/**
	 * Upload image
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function uploadImage(Request $request)
	{
		if($request->ajax()) {
			$item = WorkWithUs::findOrFail($request->get('id'));

			if($item) {
				$item->setImage($request);
				$item->save();

				return \Response::json([
					'success' => true,
					'message' => 'Изобржение загружено.',
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка.',
				]);
			}
		}
	}

	/**
	 * Delete image
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function deleteImage(Request $request)
	{
		if($request->ajax()) {

			$item = WorkWithUs::findOrFail($request->get('id'));
			$rules = $item->getRules('image');

			if(strpos($rules['image'], 'required') === false) {

				$item->deleteImage();

				$item->image = null;
				$item->save();

				return \Response::json([
					'success' => true,
					'message' => 'Изобржение удалено.',
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Изобржение нельзя удалить.',
				]);
			}
		}
	}

}