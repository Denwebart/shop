<?php
/**
 * Class ReviewsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Modules\Admin\Controllers;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ReviewsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$reviews = $this->getReviews();

		return view('admin::reviews.index', compact('reviews'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$review = new Review();
		$review->is_published = Review::PUBLISHED;

		$backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

		return view('admin::reviews.create', compact('review', 'backUrl'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$review = new Review();
		$data = $request->except('image');
		if ($data['is_published'] && is_null($review->published_at)) {
			$data['published_at'] = Carbon::now();
		} elseif (!$data['is_published']) {
			$data['published_at'] = null;
		}

		$validator = \Validator::make($data, Review::rules());

		if ($validator->fails())
		{
			return redirect(route('admin.shop_reviews.create', ['back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput()
				->with('errorMessage', 'Отзыв не сохранен. Исправьте ошибки валидации.');
		} else {
			$review->fill($data);
			$review->save();

			$review->setImage($request);
			$review->save();

			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Отзыв создан!');
			} else {
				return redirect(route('admin.shop_reviews.edit', ['id' => $review->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Отзыв создан!');
			}
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$review = Review::findOrFail($id);

		$backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

		return view('admin::reviews.edit', compact('review', 'backUrl'));
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
		$review = Review::findOrFail($id);
		$data = $request->except('user_avatar');
		if ($data['is_published'] && is_null($review->published_at)) {
			$data['published_at'] = Carbon::now();
		} elseif (!$data['is_published']) {
			$data['published_at'] = null;
		}

		$validator = \Validator::make($data, Review::rules());

		if ($validator->fails())
		{
			return redirect(route('admin.shop_reviews.edit', ['id' => $review->id, 'back_url' => urlencode($request->get('backUrl'))]))
				->withErrors($validator->errors())
				->withInput()
				->with('errorMessage', 'Отзыв не сохранен. Исправьте ошибки валидации.');
		} else {
			$review->fill($data);
			$review->setImage($request);
			$review->save();

			if($request->get('returnBack')) {
				return redirect($request->get('backUrl'))->with('successMessage', 'Отзыв сохранен!');
			} else {
				return redirect(route('admin.shop_reviews.edit', ['id' => $review->id, 'back_url' => urlencode($request->get('backUrl'))]))->with('successMessage', 'Отзыв сохранен!');
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

			$review = Review::find($id);
			$review->delete();

			$reviews = $this->getReviews();

			return \Response::json([
				'success' => true,
				'message' => 'Отзыв о магазине успешно удалён.',
				'itemsCount'      => view('parts.count')->with('models', $reviews)->render(),
				'itemsPagination' => view('parts.pagination')->with('models', $reviews)->render(),
				'itemsTable'      => view('admin::reviews.table')->with('reviews', $reviews)->render(),
			]);
		}
	}
	
	/**
	 * Get list of shop reviews
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getReviews()
	{
		return Review::select(['id', 'is_published', 'user_name', 'user_email', 'user_avatar', 'published_at'])
			->orderBy('created_at', 'DESC')
			->paginate(10);
	}
}