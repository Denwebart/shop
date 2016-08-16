<?php
/**
 * Class LettersController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Letter;
use App\Modules\Admin\Widgets\Badge;
use Carbon\Carbon;

class LettersController extends Controller
{
	public function __construct(Badge $badge)
	{
		parent::__construct($badge);
		
		$this->middleware('admin', ['only' => ['destroy']]);
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $letters = $this->getLetters();

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
	    $letter = Letter::findOrFail($id);
	    if(is_null($letter->updated_at)) {
		    $letter->updated_at = Carbon::now();
		    $letter->save();   
	    }

	    return view('admin::letters.show', compact('letter'));
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

			    $letters = $this->getLetters();

			    return \Response::json([
				    'success' => true,
				    'message' => 'Письмо успешно удалёно.',
				    'itemsCount' => view('parts.count')->with('models', $letters)->render(),
				    'itemsPagination' => view('parts.pagination')->with('models', $letters)->render(),
				    'itemsTable' => view('admin::letters.table')->with('letters', $letters)->render(),
			    ]);
		    } else {
			    return \Response::json([
				    'success' => false,
				    'message' => 'Произошла ошибка, письмо не удалёно.'
			    ]);
		    }
	    }
    }
	
	/**
	 * Get list of letters
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getLetters()
	{
		return Letter::orderBy('created_at', 'DESC')->paginate(20);
	}
}
