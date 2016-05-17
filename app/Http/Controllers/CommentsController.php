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

			$review = ProductReview::create($data);

			$product = Product::whereId($product_id)->first();
			$product->ratingInfo = $product->getRating();
			$product->rating = $product->ratingInfo['value'];
			$productReviews = $product->getReviews();

			return \Response::json([
				'success' => true,
				'id' => $review->id,
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

	/**
	 * Like/dislike for product reviews
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function vote(Request $request)
	{
		if($request->ajax()) {
			$cookieVotes = $request->cookie('productReviewVotes', []);

			if(!key_exists($request->get('id'), $cookieVotes)) {
				$vote = key_exists($request->get('vote'), ProductReview::$votes)
					? $request->get('vote')
					: ProductReview::LIKE;

				$productReview = ProductReview::whereId($request->get('id'))
					->whereIsPublished(1)
					->first();

				if(is_object($productReview)) {
					$productReview->$vote = $productReview->$vote + 1;
					$productReview->save();

					$cookieVotes[$productReview->id] = [
						'vote' => $vote,
						'created_at' => Carbon::now(),
					];

					$response = \Response::json([
						'success' => true,
						'message' => 'Спасибо за Ваше мнение!',
						'voteCount' => $productReview->$vote,
					]);

					return $response->withCookie(cookie()->forever('productReviewVotes', $cookieVotes));
				}

				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка.',
				]);
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Ваш голос не был принят. Вы уже голосовали за этот отзыв.',
				]);
			}
		}
	}
}