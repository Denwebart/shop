<?php
/**
 * Class DeliveryTypes
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Helpers\Translit;
use App\Models\DeliveryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class DeliveryTypesController extends Controller
{

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

			// доделать ресайз (в зависимости от дизайна)
			$postImage = $request->file('image');
			$data['image'] = $postImage;
			$imagePath = $deliveryType->getImagesPath();

			if($deliveryType) {

				$validator = \Validator::make($data, ['image' => 'image|max:3072',]);

				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first('image'),
						'message' => 'Изображение не загружено. Исправьте ошибки валидации.'
					]);
				}

				$deliveryType->deleteImage();

				$fileName = Translit::generateFileName($postImage->getClientOriginalName());
				$image = Image::make($postImage->getRealPath());
				File::exists($imagePath) or File::makeDirectory($imagePath, 0755, true);

				$image->save($imagePath . $fileName);

				$deliveryType->image = $fileName;
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