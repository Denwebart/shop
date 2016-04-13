<?php
/**
 * Class PagesController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Helpers\Translit;
use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Validator;

class PagesController extends Controller
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
	    $data = Input::all();
	    $image = Input::file('image');

	    $data['user_id'] = Auth::user()->id;

	    if($data['is_published']) {
		    $data['published_at'] = Carbon::now();
	    }

	    if($data['parent_id']) {
		    $parent = Page::findOrFail($data['parent_id']);
		    if($parent->type == Page::TYPE_CATALOG && $data['is_container']) {
			    $data['type'] = Page::TYPE_CATALOG;
		    }
	    }

	    $validator = \Validator::make($data, Page::rules());

	    if ($validator->fails())
	    {
		    return redirect()->back()->withErrors($validator->errors())->withInput();
	    } else {
		    $page = Page::create($data);

		    if(Input::get('returnBack')) {
			    return redirect(Input::get('backUrl'));
		    } else {
			    return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode(Input::get('backUrl'))]));
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

	    $data = Input::all();
	    $image = Input::file('image');

	    if ($data['is_published'] && is_null($page->published_at))
	    {
		    $data['published_at'] = Carbon::now();
	    }
	    elseif (!$data['is_published'])
	    {
		    $data['published_at'] = null;
	    }

	    if($page->type != Page::TYPE_SYSTEM_PAGE) {
		    if($data['parent_id']) {
			    $parent = Page::findOrFail($data['parent_id']);
			    if($parent->type == Page::TYPE_CATALOG && $data['is_container']) {
				    $data['type'] = Page::TYPE_CATALOG;
			    } else {
				    $data['type'] = Page::TYPE_PAGE;
			    }
		    } else {
			    $data['type'] = Page::TYPE_PAGE;
		    }
	    }

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
		    return redirect()->back()->withErrors($validator->errors())->withInput();
	    } else {
		    $page->fill($data);
		    $page->save();

		    if(Input::get('returnBack')) {
			    return redirect(Input::get('backUrl'));
		    } else {
			    return redirect(route('admin.pages.edit', ['id' => $page->id, 'back_url' => urlencode(Input::get('backUrl'))]));
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
	    dd('удаление страницы с id ' . $id);
    }
}
