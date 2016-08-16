<?php
/**
 * Class PagesController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $sliders = $this->getSlides();

        return view('admin::slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $slider = new Slider();
	    $slider->is_published = 1;

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::slider.create', compact('slider', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $slider = new Slider();
	    $data = $request->all();

	    $validator = \Validator::make($data, Slider::rules());

	    if ($validator->fails())
	    {
		    return redirect(route('admin.slider.create', ['back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Слайд не сохранён. Исправьте ошибки.');
	    } else {
		    $slider->fill($data);
		    $slider->save();

		    $slider->setImage($request);
		    $slider->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Слайд создан!');
		    } else {
			    return redirect(route('admin.slider.edit', ['id' => $slider->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Слайд создан!');
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
	    $slider = Slider::findOrFail($id);

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::slider.edit', compact('slider', 'backUrl'));
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
	    $slider = Slider::findOrFail($id);
	    $oldImageName = $slider->image;
	    $data = $request->all();
	    $data['button_text'] = trim($request->get('button_text')) == '' ? null : $request->get('button_text');
	    
	    $rules = Slider::rules($slider->id);
	    $rules['image'] = 'image|max:10240';

	    $validator = \Validator::make($data, $rules);

	    if ($validator->fails())
	    {
		    return redirect(route('admin.slider.edit', ['id' => $slider->id, 'back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Слайд не сохранён. Исправьте ошибки.');
	    } else {
		    $slider->fill($data);
		    $slider->image = $oldImageName;
		    $slider->setImage($request);
		    $slider->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))->with('successMessage', 'Слайд сохранён!');
		    } else {
			    return redirect(route('admin.slider.edit', ['id' => $slider->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Слайд сохранён!');
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

		    $slider = Slider::find($id);
		    $slider->delete();
			    
		    $sliders = $this->getSlides();

		    return \Response::json([
			    'success' => true,
			    'message' => 'Слайд успешно удалён.',
			    'itemsCount' => view('parts.count')->with('models', $sliders)->render(),
			    'itemsPagination' => view('parts.pagination')->with('models', $sliders)->render(),
			    'itemsTable' => view('admin::slider.table')->with('sliders', $sliders)->render(),
		    ]);

	    }
    }

	/**
	 * Get list of slides
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getSlides()
	{
		return Slider::select(['id', 'image', 'title', 'text_1', 'text_2', 'is_published', 'button_text'])
			->paginate(10);
	}
}
