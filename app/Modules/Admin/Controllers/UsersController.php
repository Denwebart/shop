<?php
/**
 * Class UsersController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$users = User::select('id', 'login', 'email', 'role', 'phone', 'firstname', 'lastname', 'avatar', 'is_active', 'created_at')
			->paginate(10);

		return view('admin::users.index', compact('users'));
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$user = new User();
		
		return view('admin::users.create', compact('user'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$user = new User();
		$data = $request->except('avatar');

		$validator = \Validator::make($data, User::rules());

		if ($validator->fails())
		{
			return redirect(route('admin.users.create', ['back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput()
				->with('errorMessage', 'Информация о пользователе не сохранена. Исправьте ошибки валидации.');
		} else {
			$user->fill($data);
			$user->save();

			$user->setImage($request);
			$user->save();

			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Пользователь создан!');
			} else {
				return redirect(route('admin.users.edit', ['id' => $user->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Пользователь создан!');
			}
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return view('admin::users.show', compact('user'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$user = User::findOrFail($id);

		$backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : \URL::previous();
		
		return view('admin::users.edit', compact('user', 'backUrl'));
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
		$user = User::findOrFail($id);
		$data = $request->except('avatar');
		
		$validator = \Validator::make($data, User::rules($user->id));
		
		if ($validator->fails())
		{
			return redirect(route('admin.users.edit', ['id' => $user->id, 'back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput()
				->with('errorMessage', 'Информация о пользователе не сохранена. Исправьте ошибки валидации.');
		} else {
			$user->fill($data);
			$user->setImage($request);
			$user->save();
			
			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Информация о пользователе сохранена!');
			} else {
				return redirect(route('admin.users.edit', ['id' => $user->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Информация о пользователе сохранена!');
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

			$user = User::find($id);
			if(!$user->isAdmin() || $user->id == \Auth::user()->id) {
				$user->delete();

				$users = User::select('id', 'login', 'email', 'role', 'phone', 'firstname', 'lastname', 'avatar', 'is_active', 'created_at')
					->paginate(10);

				return \Response::json([
					'success' => true,
					'message' => 'Пользователь успешно удален.',
					'itemsCount' => view('parts.count')->with('models', $users)->render(),
					'itemsPagination' => view('parts.pagination')->with('models', $users)->render(),
					'itemsTable' => view('admin::users.table')->with('users', $users)->render(),
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Пользователь ' . $user->login . ' не может быть удален.'
				]);
			}
		}
	}

}