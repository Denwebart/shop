<?php
/**
 * Class CartController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Setting;
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
			$premoderationModel = Setting::whereKey('premoderation.productsReviews')->whereIsActive(1)->first();
			$data['is_published'] = (is_object($premoderationModel) && $premoderationModel->value && !\Auth::check())
				? ProductReview::UNPUBLISHED
				: ProductReview::PUBLISHED;
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

			$variables = [
				'[linkToReview]' => route('admin.reviews.edit', ['id' => $review->id]),
				'[review]' => $review->text,
				'[linkToPage]' => $review->getUrl(),
				'[pageTitle]' => $review->product->getTitle(),
				'[rating]' => $review->rating
			];

			if($review->parent_id == 0 && $review->rating) {
				Notification::forAllUsers(Notification::TYPE_NEW_PRODUCT_REVIEW, $variables);
			} else {
				Notification::forAllUsers(Notification::TYPE_NEW_PRODUCT_COMMENT, $variables);
			}

			$product = Product::whereId($product_id)->first();
			$product->ratingInfo = $product->getRating();
			$product->rating = $product->ratingInfo['value'];
			$productReviews = $product->getReviews();

			$objectTitle = $data['parent_id'] ? 'комментарий' : 'отзыв';
			return \Response::json([
				'success' => true,
				'id' => $review->id,
				'message' => $data['is_published']
					? ('Ваш ' . $objectTitle . ' успешно сохранен!')
					: ('Ваш ' . $objectTitle . ' успешно отправлен 
						и будет опубликован на сайте после проверки модератором.'),
				'commentsCount' => count($productReviews),
				'newProductRating' => $product->rating,
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