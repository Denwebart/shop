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
use App\Models\RequestedCall;
use App\Models\Setting;
use App\Widgets\Articles\Articles;
use App\Widgets\Carousel\Carousel;
use App\Widgets\Reviews\Reviews;
use App\Widgets\Slider\Slider;
use App\Widgets\Viewed\Viewed;
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
				return $this->getCatalogPage($request, $settings, $page);
			} else {
				if($page->id == Page::ID_CONTACT_PAGE) {
					return $this->getContactPage($request, $settings, $page);
				} elseif($page->id == Page::ID_SITEMAP_PAGE) {
					return $this->getSitemapPage($request, $settings, $page);
				}
				return $this->getPage($request, $settings, $page);
			}
		} else {
			return $this->getProductPage($request, $settings, $page);
		}
	}

	/**
	 * Other page
	 *
	 * @param $request
	 * @param $settings
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getPage($request, $settings, $page)
	{
		$childrenPages = $page->is_container
			? $page->publishedChildren()->orderBy('published_at', 'DESC')->paginate(10)
			: [];

		\View::share('articlesWidget', new Articles());

		return view('page', compact('page', 'childrenPages'));
	}

	/**
	 * Contact page
	 *
	 * @param $request
	 * @param $settings
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getContactPage($request, $settings, $page)
	{
		$contactPageSettings = $settings->getCategory(Setting::CATEGORY_CONTACT_PAGE);

		return view('contact', compact('page', 'contactPageSettings'));
	}

	/**
	 * HTML Sitemap page
	 *
	 * @param $request
	 * @param $settings
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getSitemapPage($request, $settings, $page)
	{
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

	/**
	 * Product catalog page
	 *
	 * @param $request
	 * @param $settings
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getCatalogPage($request, $settings, $page)
	{
		// доделать вложенность (рекурсивно?)
		$subcategories = $page->publishedChildren()
			->has('products')
			->with([
				'products' => function($q) {
					$q->select('id', 'category_id');
				}
			])
			->get(['id', 'parent_id', 'menu_title', 'title', 'alias']);

		$subcategoryIds = $subcategories->pluck('id');

		$subcategoryIds[] = $page->id;

		$query = Product::select(\DB::raw('products.id, products.vendor_code, products.category_id, products.alias, products.is_published, products.title, products.price, products.image, products.image_alt, products.published_at, products.introtext, products.content, count(orders_products.id) as `popular`, SUM(products_reviews.rating) as `rating`'))
			->whereIn('category_id', $subcategoryIds)
			// sales (popular)
			->leftJoin('orders_products', 'orders_products.product_id', '=', 'products.id')
			->groupBy('products.id')
			// rating
			->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
			->where(function($q) {
				$q->where(function ($qu) {
					$qu->where('products_reviews.is_published', '=', 1)
						->where('products_reviews.parent_id', '=', 0);
				})->orWhere('products_reviews.id', '=', null);
			})
			->where('products.is_published', '=', 1)
			->where('products.published_at', '<=', Carbon::now())
			->with([
				'category' => function($q) {
					$q->select(['id', 'parent_id', 'alias', 'is_container']);
				},
				'category.parent' => function($q) {
					$q->select(['id', 'parent_id', 'alias', 'is_container']);
				},
			]);

		if($request->has('sortby')) {
			if(in_array($request->get('sortby'), Product::$sortingAttributes)) {
				$query->orderBy($request->get('sortby'), $request->get('direction', 'DESC'));
			}
		} else {
			$query->orderBy('popular', 'DESC');
		}
		$query->orderBy('published_at', 'DESC');

		$limit = $request->has('onpage')
			? $request->get('onpage')
			: $request->cookie('catalog-onpage', 12);

		$products = $query->paginate($limit);

		if(!$request->ajax()) {
			return view('catalog', compact('page', 'products', 'subcategories'));
		} else {
			return \Response::json([
				'success' => true,
				'productsListHtml' => view('parts.productsList', compact('products'))->render(),
				'countHtml' => view('parts.count')->with('models', $products)->render(),
				'pageUrl' => $products->url($request->get('page', 1)),
			])->withCookie(cookie()->forever('catalog-onpage', $limit));
		}
	}

	/**
	 * Product page
	 *
	 * @param $request
	 * @param $settings
	 * @param $page
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function getProductPage($request, $settings, $page)
	{
		$page->ratingInfo = $page->getRating();
		$page->rating = $page->ratingInfo['value'];

		// доделать вложенность (рекурсивно?)
		if($page->category) {
			$subcategoryIds = Page::select(['id', 'parent_id'])
				->whereParentId($page->category->id)
				->whereIsPublished(1)
				->where('published_at', '<=', Carbon::now())
				->pluck('id');
			$subcategoryIds[] = $page->category->id;
		}

		$query = Product::select(\DB::raw('id, category_id, alias, is_published, title, image, image_alt, published_at'))
			->whereIsPublished(1)
			->where('published_at', '<=', Carbon::now());

		if(isset($subcategoryIds)) {
			$query = $query->whereIn('category_id', $subcategoryIds);
		}

//		$page->previous = $queryPrevious->whereIn('products.id', function ($q) use($page) {
//			$q->select(\DB::raw('products.id, count(orders_products.id) as `popular`'))
//				->from('products')
//				->leftJoin('orders_products', 'orders_products.product_id', '=', 'products.id')
//				->groupBy('products.id')
//				->orderBy('popular', 'DESC')
//				->where('popular', '>', $page->sales);
//		})->first();

		$page->previous = $query->where('products.id', '=', \DB::raw('(SELECT MIN(id) FROM products WHERE id > ' . $page->id . ')'))
			->first();

		$query = Product::select(\DB::raw('id, category_id, alias, is_published, title, image, image_alt, published_at'))
			->whereIsPublished(1)
			->where('published_at', '<=', Carbon::now());

		if(isset($subcategoryIds)) {
			$query = $query->whereIn('category_id', $subcategoryIds);
		}

		$page->next = $query->where('products.id', '=', \DB::raw('(SELECT MAX(id) FROM products WHERE id < ' . $page->id . ')'))
			->first();

		$productReviews = $page->getReviews();
		$viewed = new Viewed();

		return view('product', compact('page', 'productReviews', 'viewed'));
	}

	/**
	 * XML Sitemap
	 *
	 * @param Settings $settings
	 * @return \Illuminate\Contracts\View\View
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function sitemapXml(Settings $settings)
	{
		$sitemapItems = Page::whereParentId(0)
			->whereIsPublished(1)
			->where('published_at', '<', date('Y-m-d H:i:s'))
			->with([
				'publishedChildren' => function($query) {
					$query->select('id', 'parent_id', 'type', 'is_container', 'alias', 'title', 'menu_title', 'updated_at', 'published_at');
				},
				'publishedProducts' => function($query) {
					$query->select('id', 'category_id', 'alias', 'title');
				},
			])
			->get(['id', 'parent_id', 'type', 'is_container', 'alias', 'title', 'menu_title', 'updated_at', 'published_at']);

		$content = \View::make('sitemapXml', compact('sitemapItems'))->render();

		return response($content)->header('Content-Type', 'text/xml');
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
			$data['updated_at'] = null;
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

	/**
	 * Requesting call
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function requestCall(Request $request)
	{
		if($request->ajax()) {
			$data = $request->all();
			$messages = [
				'name.required' => 'Введите Ваше имя',
				'phone.required' => 'Введите Ваш номер телефона'
			];
			$validator = \Validator::make($data, RequestedCall::rules(), $messages);

			if($validator->fails()) {
				return \Response::json([
					'success' => false,
					'message' => 'Запрос не отправлен. Исправьте ошибки валидации.',
					'errors' => $validator->errors()
				]);
			}

			RequestedCall::create($data);

			return \Response::json([
				'success' => true,
				'message' => 'Ваш запрос успешно отправлен! Менеджер свяжется с вами в течение рабочего дня call-центра.',
			]);
		}
	}

	/**
	 * Remember in cookie
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function rememberInCookie(Request $request)
	{
		if($request->ajax() && $request->get('key')) {
			return \Response::json([
				'success' => true,
			])->withCookie(cookie()->forever($request->get('key'), $request->get('value')));
		}
	}
}