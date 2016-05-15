<?php
/**
 * Class CartController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\ProductReview;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
	/**
	 * Add review to product
	 *
	 * @param Request $request
	 * @param integer $product_id
	 * @return \Illuminate\Http\JsonResponse
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function add(Request $request, $product_id)
	{
		if($request->ajax()) {
			$data = $request->all();
			$data['user_id'] = \Auth::check() ? \Auth::user()->id : null;
			$data['product_id'] = $product_id;
			$data['is_published'] = ProductReview::PUBLISHED;
			$data['published_at'] = Carbon::now();

			$validator = \Validator::make($data, ProductReview::rules());

			if($validator->fails()) {
				return \Response::json([
					'success' => false,
					'message' => $data['parent_id']
						? 'Комментарий не сохранен. Исправьте ошибки валидации.'
						: 'Отзыв не сохранен. Исправьте ошибки валидации.',
					'errors' => $validator->errors()
				]);
			}

			ProductReview::create($data);

			$product = Product::whereId($product_id)->first();
			$product->ratingInfo = $product->getRating();
			$product->rating = $product->ratingInfo['value'];
			$productReviews = $product->getReviews();

			return \Response::json([
				'success' => true,
				'message' => $data['parent_id']
					? 'Ваш комментарий успешно сохранен!'
					: 'Ваш отзыв успешно сохранен!',
				'commentsCount' => count($productReviews),
				'commentsHtml' => view('parts.comments')
					->with('page', $product)
					->with('productReviews', $productReviews)
					->render()
			]);
		}
	}
}