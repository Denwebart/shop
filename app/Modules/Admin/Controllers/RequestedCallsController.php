<?php
/**
 * Class RequestedCallsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\RequestedCall;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class RequestedCallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $calls = RequestedCall::paginate(10);

        return view('admin::requestedcalls.index', compact('calls'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $call = RequestedCall::findOrFail($id);

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::requestedcalls.edit', compact('call', 'backUrl'));
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
	    $call = RequestedCall::findOrFail($id);
	    $data = $request->all();
	    if(!$call->user_id) {
		    $data['user_id'] = Auth::user()->id;
		    $data['answered_at'] = Carbon::now();
	    }
	    $validator = \Validator::make($data, RequestedCall::rules());

	    if ($validator->fails())
	    {
		    return redirect(route('admin.calls.edit', ['id' => $call->id, 'back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Информация не сохранена. Исправьте ошибки валидации.');
	    } else {
		    $call->fill($data);
		    $call->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Информация сохранена!');
		    } else {
			    return redirect(route('admin.calls.edit', ['id' => $call->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Информация сохранена!');
		    }
	    }
    }
}
