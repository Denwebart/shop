<?php
/**
 * Class PagesController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\URL;

class ProductsReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $productsReviews = $this->getReviews();

        return view('admin::productsReviews.index', compact('productsReviews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $productReview = ProductReview::findOrFail($id);
	    $productReview->updated_at = Carbon::now();
	    $productReview->save();

	    $backUrl = \Request::has('back_url') ? urldecode(\Request::get('back_url')) : URL::previous();

	    return view('admin::productsReviews.edit', compact('productReview', 'backUrl'));
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
	    $review = ProductReview::findOrFail($id);
	    $data = $request->all();
	    $data['product_id'] = $review->product_id;
	    $data['updated_at'] = Carbon::now();

	    if ($data['is_published'] && is_null($review->published_at)) {
		    $data['published_at'] = Carbon::now();
	    } elseif (!$data['is_published']) {
		    $data['published_at'] = null;
	    }

	    $validator = \Validator::make($data, ProductReview::rules());

	    if ($validator->fails())
	    {
		    return redirect(route('admin.reviews.edit', ['id' => $review->id, 'back_url' => urlencode($request->get('backUrl'))]))
			    ->withErrors($validator->errors())
			    ->withInput()
			    ->with('errorMessage', 'Информация не сохранена.');
	    } else {
		    $review->fill($data);
		    $review->save();

		    if($request->get('returnBack')) {
			    return redirect($request->get('backUrl'))
				    ->with('successMessage', 'Информация сохранена!');
		    } else {
			    return redirect(route('admin.reviews.edit', ['id' => $review->id, 'back_url' => urlencode($request->get('backUrl'))]))
				    ->with('successMessage', 'Информация сохранена!');
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

		    if(ProductReview::destroy($id)){

			    $productsReviews = $this->getReviews();

			    return \Response::json([
				    'success' => true,
				    'message' => 'Отзыв успешно удалён.',
				    'itemsCount' => view('parts.count')->with('models', $productsReviews)->render(),
				    'itemsPagination' => view('parts.pagination')->with('models', $productsReviews)->render(),
				    'itemsTable' => view('admin::productsReviews.table')->with('productsReviews', $productsReviews)->render(),
			    ]);
		    } else {
			    return \Response::json([
				    'success' => false,
				    'message' => 'Произошла ошибка, отзыв не удалён.'
			    ]);
		    }
	    }
    }

	/**
	 * Get list of products reviews
	 *
	 * @return mixed
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getReviews()
	{
		return ProductReview::select(['id', 'parent_id', 'user_id', 'product_id', 'rating', 'like', 'dislike', 'user_name', 'user_email', 'is_published', 'created_at', 'updated_at', 'published_at'])
			->with('user', 'product')
			->orderBy('created_at', 'DESC')
			->paginate(20);
	}
}
