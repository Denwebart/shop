<?php
/**
 * Class SettingsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Menu;
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
     * @return \Illuminate\Http\Response
     */
    public function index(\App\Helpers\Settings $settings)
    {
	    $settings = $settings->getAll();

	    $menuItems = Menu::getMenuItems();

        return view('admin::settings.index', compact('settings', 'menuItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $setting = Setting::findOrFail($id);

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : \URL::previous();

	    return view('admin::settings.edit', compact('setting', 'backUrl'));
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
	    $setting = Setting::findOrFail($id);
	    $data = $request->all();
	    $data['value'] = trim($request->get('value')) ? trim($request->get('value')) : null;

	    $validator = \Validator::make($data, $setting->getRules());

	    if ($validator->fails())
	    {
		    return redirect(route('admin.settings.edit', ['id' => $setting->id, 'back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Информация не сохранена. Исправьте ошибки валидации.');
	    } else {
		    $setting->fill($data);
		    $setting->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Информация сохранена!');
		    } else {
			    return redirect(route('admin.settings.edit', ['id' => $setting->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Информация сохранена!');
		    }
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
			$id = $request->has('pk') ? $request->get('pk') : $request->get('id');
			$setting = Setting::findOrFail($id);

			if($setting) {
				$data = $request->all();
				$data['value'] = ($setting->type == Setting::TYPE_BOOLEAN)
					? $request->get('value')
					: (trim($request->get('value'))
						? trim($request->get('value'))
						: null);

				$validator = \Validator::make($data, $setting->getRules());

				if ($validator->fails())
				{
					return \Response::json([
						'success' => false,
						'error' => $validator->errors()->first('value'),
						'message' => 'Значение не изменено. Исправьте ошибки валидации.'
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
						'message' => 'Изображение не загружено. Исправьте ошибки валидации.'
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