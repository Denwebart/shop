<?php
/**
 * Class SiteController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Http\Controllers;


use App\Helpers\Settings;
use App\Models\Letter;
use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;
use App\Widgets\Carousel\Carousel;
use App\Widgets\Reviews\Reviews;
use App\Widgets\Slider\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller
{
	/**
	 * Main page
	 * 
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function index() {

		$page = Page::whereAlias('/')->firstOrFail();

		$slider = new Slider();
		$carousel = new Carousel();
		$review = new Reviews();

		$bestSellers = Product::select(\DB::raw('products.id, products.vendor_code, products.category_id, products.alias, products.is_published, products.title, products.price, products.image, products.image_alt, products.published_at, count(orders_products.product_id) as `boughtTimes`'))
			->leftJoin('orders_products', 'products.id', '=', 'orders_products.product_id')
			->with('category', 'category.parent')
			->where('products.is_published', '=', 1)
			->groupBy('orders_products.product_id')
			->orderBy('boughtTimes', 'DESC')
			->orderBy('products.published_at', 'DESC')
			->limit(12)
			->get();

		return view('index', compact('page', 'slider', 'carousel', 'bestSellers', 'review'));
	}

	/**
	 * Other pages
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param object $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function pageOneLevel(\Illuminate\Http\Request $request, Settings $settings, $page)
	{
		return $this->renderPage($request, $settings, $page);
	}

	public function pageTwoLevel(\Illuminate\Http\Request $request, Settings $settings, $parentOne, $page)
	{
		return $this->renderPage($request, $settings, $page);
	}

	public function pageThreeLevel(\Illuminate\Http\Request $request, Settings $settings, $parentOne, $parentTwo, $page)
	{
		return $this->renderPage($request, $settings, $page);
	}

	public function pageFourLevel(\Illuminate\Http\Request $request, Settings $settings, $parentOne, $parentTwo, $parentThree, $page)
	{
		return $this->renderPage($request, $settings, $page);
	}

	protected function renderPage($request, $settings, $page)
	{
		if(url($request->getPathInfo()) != $page->getUrl()) {
			abort(404);
		}
		if(is_a($page, 'App\Models\Page')) {
			if($page->type == Page::TYPE_CATALOG) {
				// доделать вложенность
				$subcategoryIds = Page::select(['id', 'parent_id'])
					->whereParentId($page->id)
					->whereIsPublished(1)
					->where('published_at', '<', Carbon::now())
					->pluck('id');

				$subcategoryIds[] = $page->id;

				// доделать сортировку по популярности
				$products = Product::whereIn('category_id', $subcategoryIds)
					->whereIsPublished(1)
					->where('published_at', '<', Carbon::now())
					->with([
						'category' => function($q) {
							$q->select(['id', 'parent_id', 'alias', 'is_container']);
						}
					])
					->paginate(12);

				return view('catalog', compact('page', 'products'));
			} else {
				if($page->id == Page::ID_CONTACT_PAGE) {
					$contactPageSettings = $settings->getCategory(Setting::CATEGORY_CONTACT_PAGE);

					return view('contact', compact('page', 'contactPageSettings'));
				} elseif($page->id == Page::ID_SITEMAP_PAGE) {
					
					$sitemapItems = Page::whereParentId(0)
						->whereIsPublished(1)
						->where('published_at', '<', date('Y-m-d H:i:s'))
						->with([
							'publishedChildren' => function($query) {
								$query->select('id', 'parent_id', 'type', 'is_container', 'alias', 'title', 'menu_title');
							},
							'publishedProducts' => function($query) {
								$query->select('id', 'category_id', 'alias', 'title');
							},
						])
						->get(['id', 'parent_id', 'type', 'is_container', 'alias', 'title', 'menu_title']);

					return view('sitemap', compact('page', 'sitemapItems'));
				}
				
				return view('page', compact('page'));
			}
		} else {
			$page->ratingInfo = $page->getRating();
			$page->rating = $page->ratingInfo['value'];
			$productReviews = $page->getReviews();
			return view('product', compact('page', 'productReviews'));
		}
	}


	/**
	 * Sending letter from contact form
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function sendLetter(Request $request)
	{
		if($request->ajax()) {
			$data = $request->all();
			$validator = \Validator::make($data, Letter::rules());

			if($validator->fails()) {
				return \Response::json([
					'success' => false,
					'message' => 'Письмо не отправлено. Исправьте ошибки валидации.',
					'errors' => $validator->errors()
				]);
			}

			Letter::create($data);

			return \Response::json([
				'success' => true,
				'message' => 'Ваше письмо успешно отправлено!',
			]);
		}
	}
}