<?php
/**
 * Class SettingsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $settings = Setting::select('id', 'key', 'type', 'category', 'title', 'description', 'value', 'is_active')
		    ->paginate(20);

        return view('admin::settings.index', compact('settings'));
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

}
