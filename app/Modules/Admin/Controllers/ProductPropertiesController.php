<?php
/**
 * Class ProductPropertiesController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\DeliveryType;
use App\Models\ProductPropertyValue;
use Illuminate\Http\Request;

class ProductPropertiesController extends Controller
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

			$validator = \Validator::make($data, DeliveryType::$rules);

			if ($validator->fails())
			{
				return \Response::json([
					'success' => false,
					'errors' => $validator->errors(),
					'message' => 'Значение не добавлено. Исправьте ошибки валидации.'
				]);
			} else {
				$deliveryType = DeliveryType::create($data);
				$deliveryType->setImage($request);
				$deliveryType->save();

				return \Response::json([
					'success' => true,
					'message' => 'Значение добавлено.',
					'itemHtml' => view('admin::deliveryTypes.item', compact('deliveryType'))->render(),
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
	public function delete(Request $request)
	{
		if($request->ajax()) {
			$productValue = ProductPropertyValue::whereProductId(intval($request->get('productId')))
				->wherePropertyValueId(intval($request->get('valueId')))
				->first();

			if(is_object($productValue)) {
//			    $product = Product::find($request->get('productId'));
				$product = $productValue->product;

				$productValue->delete();

				$property = $product->getProperties($request->get('propertyId'));
				$property = $property->first();

				return \Response::json([
					'success' => true,
					'message' => 'Значение успешно удалено.',
					'propertyHtml' => view('admin::productProperties.item', compact('property', 'product'))->render(),
				]);
			}
			
			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка, значение не удалено.'
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
			$deliveryType = DeliveryType::findOrFail($request->get('pk'));

			$field = $request->get('name');
			if($deliveryType && $field) {
				$data = $request->all();
				$data[$field] = trim($request->get('value')) ? trim($request->get('value')) : null;

				$validator = \Validator::make($data, $deliveryType->getRules($field));

				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first('value'),
						'message' => 'Значение не изменено. Исправьте ошибки валидации.'
					]);
				} else {
					$deliveryType->$field = $data['value'];
					$deliveryType->save();

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
			$deliveryType = DeliveryType::findOrFail($request->get('id'));

			if($deliveryType) {
				$deliveryType->is_active = $request->get('is_active');
				$deliveryType->save();

				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . DeliveryType::$is_active[$deliveryType->is_active] . '".'
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