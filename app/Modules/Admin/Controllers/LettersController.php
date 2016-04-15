<?php
/**
 * Class PagesController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Letter;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class LettersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $letters = Letter::paginate(10);

        return view('admin::letters.index', compact('letters'));
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    if(\Request::ajax()) {

		    if(Letter::destroy($id)){

			    $letters = Letter::paginate(10);

			    return \Response::json([
				    'success' => true,
				    'message' => 'Писомо успешно удалено.',
				    'itemsCount' => view('parts.count')->with('models', $letters)->render(),
				    'itemsPagination' => view('parts.pagination')->with('models', $letters)->render(),
				    'itemsTable' => view('admin::letters.table')->with('letters', $letters)->render(),
			    ]);
		    } else {
			    return \Response::json([
				    'success' => false,
				    'message' => 'Произошла ошибка, письмо не удалено.'
			    ]);
		    }
	    }
    }
}
