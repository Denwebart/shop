<?php
/**
 * Class ProductPropertiesController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\DeliveryType;
use App\Models\Product;
use App\Models\ProductPropertyValue;
use App\Models\PropertyValue;
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

			if(!$request->get('valueId') && (!$request->has('valueTitle') || empty($request->get('valueTitle')))) {
				return \Response::json([
					'success' => false,
					'message' => 'Значение не добавлено. Выберите значение характеристики, которое хотите добавить.'
				]);
			}

			$propertyValue = PropertyValue::whereId($request->get('valueId'))
				->orWhere('value', '=', $request->get('valueTitle'))
				->first();

			if(!$propertyValue) {
				return \Response::json([
					'success' => false,
					'message' => 'Значение не добавлено. Значение, которое вы хотите добавить, не существует.'
				]);
			}

			$productValue = ProductPropertyValue::whereProductId(intval($request->get('productId')))
				->wherePropertyValueId(intval($request->get('valueId')))
				->first();

			if($productValue) {
				return \Response::json([
					'success' => false,
					'message' => 'Такое значение характеристики уже добавлено для этого товара.'
				]);
			}

			$productValue = new ProductPropertyValue();
			$productValue->product_id = $request->get('productId');
			$productValue->property_value_id = $propertyValue->id;

			if($productValue->save()) {
				$product = Product::find($request->get('productId'));
				if($product) {
					$property = $product->getProperties($request->get('propertyId'));
					$property = $property->first();
				} else {
					$property = [];
				}

				return \Response::json([
					'success' => true,
					'message' => 'Значение успешно добавлено.',
					'propertyHtml' => view('admin::productProperties.item', compact('property', 'product'))->render(),
				]);
			}
		}
	}

	/**
	 * Autocomplete property values for adding to products
	 *
	 * @param Request $request
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function autocomplete(Request $request) {
		$term = $request->get('term');
		$values = PropertyValue::wherePropertyId($request->get('propertyId'))
			->where('value', 'like', "%$term%")
			->get(['id', 'value', 'additional_value']);
		$result = [];
		foreach($values as $item) {
			$result[] = ['id' => $item->id, 'value' => $item->value];
		}
		return \Response::json($result);
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


}