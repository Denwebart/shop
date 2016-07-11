<?php
/**
 * Class PropertiesController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
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

			$validator = \Validator::make($data, Property::$rules);

			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Характериистика товара не добавлена. Исправьте ошибки.'
				]);
			} else {
				Property::create($data);

				$properties = Property::with(['values', 'values.products'])->get();

				return \Response::json([
					'success' => true,
					'message' => 'Характериистика товара успешно добавлена.',
					'propertiesHtml' => view('admin::properties.properties', compact('properties'))->render(),
				]);
			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка.'
			]);
		}
	}

	/**
	 * Delete delivery type
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

			if (Property::destroy($request->get('id')))
			{
				return \Response::json([
					'success' => true,
					'message' => 'Характериистика товара успешно удалена.'
				]);
			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка. Характериистика товара не удалена.',
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
			$property = Property::findOrFail($request->get('pk'));

			$field = $request->get('name');
			if($property && $field) {
				$data = $request->all();
				$data[$field] = trim($request->get('value')) ? trim($request->get('value')) : null;

				$validator = \Validator::make($data, $property->getRules($field));

				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first($field),
						'message' => 'Значение не изменено. Исправьте ошибки.'
					]);
				} else {
					$property->$field = $data['value'];
					$property->save();

					return \Response::json([
						'success' => true,
						'message' => 'Значение успешно изменено.'
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
			$deliveryType = DeliveryType::findOrFail($request->get('id'));

			if($deliveryType) {
				$deliveryType->setImage($request);
				$deliveryType->save();

				return \Response::json([
					'success' => true,
					'message' => 'Изобржение загружено.'
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
			$deliveryType = DeliveryType::findOrFail($request->get('id'));

			if($deliveryType) {

				$deliveryType->deleteImage();

				$deliveryType->image = null;
				$deliveryType->save();

				return \Response::json([
					'success' => true,
					'message' => 'Изобржение удалено.'
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