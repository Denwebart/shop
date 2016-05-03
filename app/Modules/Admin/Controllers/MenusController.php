<?php
/**
 * Class MenusController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Validator;
use Illuminate\View\View;

class MenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $pages = Page::select(['id', 'parent_id', 'alias', 'type', 'is_container', 'is_published', 'title', 'menu_title', 'published_at'])
		    ->with('parent')
		    ->paginate(10);

        return view('admin::pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $page = new Page();

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::pages.create', compact('page', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $page = new Page();
	    $data = $request->except('image');
	    $data = array_merge($data, $page->setData($data));

	    $validator = \Validator::make($data, Page::rules());

	    if ($validator->fails())
	    {
		    return redirect(route('admin.pages.create', ['back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Страница не сохранена. Исправьте ошибки валидации.');
	    } else {
		    $page->fill($data);
		    $page->save();

		    $page->setImage($request);
		    $page->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Страница создана!');
		    } else {
			    return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Страница создана!');
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
	    //доделать
        dd('просмотр страницы с id ' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $page = Page::findOrFail($id);

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::pages.edit', compact('page', 'backUrl'));
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
	    $page = Page::findOrFail($id);
	    $data = $request->except('image');
	    $data = array_merge($data, $page->setData($data));

	    $rules = Page::rules($page->id);
	    $messages = [];
	    // validation rule for main page
	    if($page->isMain()) {
		    $rules['alias'] = 'regex:/^[\/]+$/u';
		    $messages['alias.regex'] = 'Алиас главной страницы нельзя изменить.';
	    }
	    $validator = \Validator::make($data, $rules, $messages);

	    if ($validator->fails())
	    {
		    return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Страница не сохранена. Исправьте ошибки валидации.');
	    } else {
		    $page->fill($data);
		    $page->setImage($request);
		    $page->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Страница сохранена!');
		    } else {
			    return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Страница сохранена!');
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

		    $page = Page::find($id);
		    if($page->canBeDeleted()) {
			   $page->delete();
			    
			    $pages = Page::select(['id', 'parent_id', 'alias', 'type', 'is_container', 'is_published', 'title', 'menu_title', 'published_at'])
				    ->with('parent')
				    ->paginate(10);

			    return \Response::json([
				    'success' => true,
				    'message' => 'Страница успешно удалена.',
				    'itemsCount' => view('parts.count')->with('models', $pages)->render(),
				    'itemsPagination' => view('parts.pagination')->with('models', $pages)->render(),
				    'itemsTable' => view('admin::pages.table')->with('pages', $pages)->render(),
			    ]);
		    } else {
			    return \Response::json([
				    'success' => false,
				    'message' => 'Эта страница не может быть удалена.'
			    ]);
		    }
	    }
    }
}