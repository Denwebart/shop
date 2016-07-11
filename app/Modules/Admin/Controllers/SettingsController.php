<?php
/**
 * Class SettingsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Helpers\Settings;
use App\Models\Menu;
use App\Models\Property;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param Settings $settings
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
    public function general(Settings $settings)
    {
	    $settings = $settings->getAll();

	    $menuItems = Menu::getMenuItems();

        return view('admin::settings.general', compact('settings', 'menuItems'));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @param Settings $settings
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function widgets(Settings $settings)
	{
		$settings = $settings->getAll();

		return view('admin::settings.widgets', compact('settings'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Settings $settings
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function checkout(Settings $settings)
	{
		$settings = $settings->getAll();

		return view('admin::settings.checkout', compact('settings'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function properties()
	{
		$properties = Property::with(['values', 'values.products'])->get();
		foreach ($properties as $property) {
			foreach($property->values as $propertyValue) {
				$property->productsCount += count($propertyValue->products);
			}
		}

		return view('admin::settings.properties', compact('properties'));
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
			$id = $request->has('pk') ? $request->get('pk') : $request->get('id');
			$setting = Setting::findOrFail($id);

			if($setting) {
				$data = $request->all();
				$data['value'] = ($setting->type == Setting::TYPE_BOOLEAN)
					? $request->get('value')
					: (trim($request->get('value'))
						? trim($request->get('value'))
						: null);

				$validator = \Validator::make($data, $setting->getRules(), $setting->getMessages());

				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first('value'),
						'message' => 'Значение не изменено. Исправьте ошибки.'
					]);
				} else {
					$setting->value = $data['value'];
					$setting->save();

					return \Response::json([
						'success' => true,
						'message' => 'Значение изменено.'
					]);
				}
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка.'
				]);
			}
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
			$setting = Setting::findOrFail($request->get('id'));

			if($setting) {
				$setting->is_active = $request->get('value');
				$setting->save();

				return \Response::json([
					'success' => true,
					'message' => 'Статус изменен на "' . Setting::$is_active[$setting->is_active] . '".'
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
			$setting = Setting::findOrFail($request->get('id'));

			$postImage = $request->file('image');
			$data['value'] = $postImage;
			$imagePath = public_path('images/');

			if($setting && $setting->type == Setting::TYPE_IMAGE && isset($postImage)) {

				$validator = \Validator::make($data, $setting->getRules());

				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first('value'),
						'message' => 'Изображение не загружено. Исправьте ошибки.'
					]);
				}

				if (File::exists(public_path('images/') . $setting->value)) {
					File::delete(public_path('images/') . $setting->value);
				}

				$fileName = str_replace('.', '-', $setting->key) . '.' . pathinfo($postImage->getClientOriginalName(), PATHINFO_EXTENSION);
				$image = Image::make($postImage->getRealPath());

				$image->save($imagePath . $fileName);

				$setting->value = $fileName;
				$setting->save();

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
			$setting = Setting::findOrFail($request->get('id'));

			if($setting && $setting->type == Setting::TYPE_IMAGE) {

				if (File::exists(public_path('images/') . $setting->value)) {
					File::delete(public_path('images/') . $setting->value);
				}

				$setting->value = null;
				$setting->save();

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