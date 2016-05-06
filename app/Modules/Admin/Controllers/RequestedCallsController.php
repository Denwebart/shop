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
	    $calls = RequestedCall::with(['user'])->paginate(10);

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
	    $call = RequestedCall::with(['user'])->findOrFail($id);

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
	    $rules = RequestedCall::rules();
	    $rules['status'] = 'integer|between:1,2';
	    $messages = ['status.between' => 'Вы не можете сохранить, не выставив статус.'];
	    $validator = \Validator::make($data, $rules, $messages);

	    if ($validator->fails())
	    {
		    return redirect(route('admin.calls.edit', ['id' => $call->id, 'back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Информация не сохранена.');
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(\Request::ajax()) {

			if(RequestedCall::destroy($id)){

				$calls = RequestedCall::paginate(10);

				return \Response::json([
					'success' => true,
					'message' => 'Звонок успешно удалён.',
					'itemsCount' => view('parts.count')->with('models', $calls)->render(),
					'itemsPagination' => view('parts.pagination')->with('models', $calls)->render(),
					'itemsTable' => view('admin::requestedCalls.table')->with('calls', $calls)->render(),
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка, звонок не был удалён.'
				]);
			}
		}
	}
}
