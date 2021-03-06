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
use App\Models\Notification;
use App\Models\Page;
use App\Models\Product;
use App\Models\Property;
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
		
		$leadersOfSells = \Cache::rememberForever('leadersOfSells', function() {
			$query = Product::select(\DB::raw('products.id, products.vendor_code, products.category_id, products.alias, products.is_published, products.title, products.price, products.image, products.image_alt, products.published_at'))
				->with('category', 'category.parent', 'propertyColor')
				->where('products.is_published', '=', 1);
			
			$query->leftJoin('orders_products', 'orders_products.product_id', '=', 'products.id')
				->addSelect(\DB::raw('COUNT(distinct orders_products.id) as `popular`'));
			
			$query->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
				->where(function($q) {
					$q->where(function ($qu) {
						$qu->where('products_reviews.parent_id', '=', 0);
					})->orWhereNull('products_reviews.id');
				})
				->addSelect(\DB::raw('COUNT(distinct products_reviews.id) as reviews_count'));
			
			$query->groupBy('products.id')
				->orderBy('popular', 'DESC')
				->orderBy('reviews_count', 'DESC')
				->orderBy('products.published_at', 'DESC')
				->limit(12);
			
			return $query->get();
		});

		return view('index', compact('page', 'slider', 'carousel', 'leadersOfSells', 'review'));
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
		$childrenPages = \Cache::rememberForever('page.'. $page->id .'.children', function() use($page) {
			return $page->is_container
				? $page->publishedChildren()->orderBy('published_at', 'DESC')->paginate(10)
				: [];
		});

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
		$sitemapItems = \Cache::rememberForever('sitemapItems', function() {
			return Page::whereParentId(0)
				->whereIsPublished(1)
				->where('published_at', '<', date('Y-m-d H:i:s'))
				->get(['id', 'parent_id', 'type', 'is_container', 'alias', 'title', 'menu_title']);
		});

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
		$subcategories = \Cache::rememberForever('catalog.' . $page->id . '.subcategories', function() use($page) {
			return $page->publishedChildren()
				->has('products')
				->with([
					'products' => function($q) {
						$q->select('id', 'category_id');
					}
				])
				->get(['id', 'parent_id', 'menu_title', 'title', 'alias']);
		});

		// get products
		$query = Product::select(\DB::raw('products.id, products.vendor_code, products.category_id, products.alias, products.is_published, products.title, products.price, products.image, products.image_alt, products.published_at, products.introtext, products.content'))
			->where('products.is_published', '=', 1)
			->where('products.published_at', '<=', Carbon::now())
			->with([
				'category' => function($q) {
					$q->select(['id', 'parent_id', 'alias', 'is_container']);
				},
				'category.parent' => function($q) {
					$q->select(['id', 'parent_id', 'alias', 'is_container']);
				},
				'propertyColor'
			]);

		// сброс фильтров
		if($request->get('reset-filters')) {
			$url = url($request->decodedPath());
		}

		// покатегория
		if($request->has('subcat') && $request->get('subcat') && !$request->get('reset-filters')) {
			$subcategoryIds = $page->publishedChildren()
				->whereIn('alias', explode(',', $request->get('subcat')))
				->pluck('id');
		} else {
			$subcategoryIds = $subcategories->pluck('id');
			$subcategoryIds[] = $page->id;
		}
		$query->whereIn('category_id', $subcategoryIds);

		// цена
		if($request->has('price') && $request->get('price') && !$request->get('reset-filters')) {
			$price = $request->get('price');
			$query->where('products.price', '>=', $price['start'])
				->where('products.price', '<=', $price['end']);
		}

		// максимальная/минимальная цена
		$subcat = $subcategories->pluck('id');
		$subcat[] = $page->id;
		$rangePrice = Product::select(['id', 'price'])
			->whereIn('category_id', $subcat)
			->where('products.is_published', '=', 1)
			->where('products.published_at', '<=', Carbon::now())
			->orderBy('price', 'DESC')
			->get();

		// фильтрация по характеристикам (properties)
		$postProperties = array_filter($request->except(['price', 'page', 'subcat']));
		if($postProperties && !$request->get('reset-filters')) {
			$properties = Property::whereIn('title', array_flip($postProperties))->get();
		}
		if(isset($properties)) {
			foreach ($properties as $property) {
				$query->whereHas('productProperties', function ($qu) use($properties, $request, $property) {
					if($request->has($property->title)) {
						$propertyValues = explode(',', $request->get($property->title));
						$qu->where(function ($q) use($property, $propertyValues) {
							$q->where('property_values.property_id', '=', $property->id);
							$i = 0;
							foreach ($propertyValues as $value) {
								if(!$i) {
									$q->where('property_values.value', '=', $value);
								} else {
									$q->orWhere('property_values.value', '=', $value);
								}
								$i++;
							}
						});
					}
				});
			}
		}

		// доделать тег новое в константы + нельзя удалить
		if($request->has('new') && !$request->get('reset-filters')) {
			$query->whereDate('products.published_at', '>', Carbon::now()->subDay($request->get('new')));
		}

		// сортировка
		if($request->has('sortby') && !$request->get('reset-filters') && in_array($request->get('sortby'), Product::$sortingAttributes)) {
			$sortby = $request->get('sortby');
		} else {
			$sortby = $request->cookie('sortby', 'popular');
		}
		$direction = $request->has('direction') ? $request->get('direction') : $request->cookie('direction', 'DESC');

		// sort by sales (popular)
		if($sortby == 'popular') {
			$query->leftJoin('orders_products', 'orders_products.product_id', '=', 'products.id')
				->addSelect(\DB::raw('COUNT(distinct orders_products.id) as `popular`'));

			$query->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
				->where(function($q) {
					$q->where(function ($qu) {
						$qu->where('products_reviews.parent_id', '=', 0);
					})->orWhereNull('products_reviews.id');
				})
				->addSelect(\DB::raw('COUNT(distinct products_reviews.id) as reviews_count'));

			$query->orderBy('popular', $direction);
			$query->orderBy('reviews_count', $direction);
		}
		// sort by rating
		elseif($sortby == 'rating') {
			$query->leftJoin('products_reviews', 'products_reviews.product_id', '=', 'products.id')
				->where(function($q) {
					$q->where(function ($qu) {
						$qu->where('products_reviews.parent_id', '=', 0);
					})->orWhereNull('products_reviews.id');
				})
				->addSelect(\DB::raw('CASE WHEN (products_reviews.is_published = 1 && products_reviews.rating != 0) THEN (SUM(products_reviews.rating) / COUNT(CASE WHEN (products_reviews.is_published = 1 && products_reviews.rating != 0) THEN 1 END)) ELSE 0 END as rating'));
			$query->orderBy($sortby, $direction);
		} else {
			$query->orderBy($sortby, $direction);
		}
		$query->orderBy('products.published_at', $direction);
		$query->groupBy('products.id');

		// кол-во на странице
		$limit = ($request->has('onpage') && !$request->get('reset-filters'))
			? $request->get('onpage')
			: $request->cookie('catalog-onpage', 12);

		$products = $query->paginate($limit);
		
		$properties = \Cache::rememberForever('properties', function() {
			return Property::with(['values'])->get();
		});

		if(!$request->ajax()) {
			return view('catalog', compact('page', 'products', 'subcategories', 'rangePrice', 'properties'));
		} else {
			return \Response::json([
				'success' => true,
				'productsListHtml' => view('parts.productsList', compact('products'))->render(),
				'countHtml' => view('parts.count')->with('models', $products)->render(),
				'pageUrl' => isset($url) ? $url : $products->url($request->get('page', 1)),
			])->withCookie(cookie()->forever('catalog-onpage', $limit))
				->withCookie(cookie()->forever('sortby', strtolower($sortby)))
				->withCookie(cookie()->forever('direction', strtolower($direction)));
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
		$page->ratingInfo = \Cache::rememberForever('product.' . $page->id . '.rating', function() use($page) {
			return $page->getRating();
		});
		
		$page->rating = $page->ratingInfo['value'];
		
		// previous / next
		$direction = $request->cookie('direction', 'desc');
		$previousNext = $page->getPreviousNext($request->cookie('sortby', 'popular'));
		$page->previous = ($direction == 'desc')
			? collect($previousNext)->first()
			: collect($previousNext)->last();
		$page->next = ($direction == 'desc')
			? collect($previousNext)->last()
			: collect($previousNext)->first();
		
		$productReviews = \Cache::rememberForever('product.' . $page->id . '.reviews', function() use($page) {
			return $page->getReviews();
		});
		
		$viewed = new Viewed();
		
		$productProperties = \Cache::rememberForever('product.' . $page->id . '.properties', function() use($page) {
			return $page->getProperties();
		});
		
		foreach($productProperties as $key => $property) {
			if($property->type == Property::TYPE_COLOR || $property->type == Property::TYPE_TAG || $property->type == Property::TYPE_SIZE) {
				if($property->type == Property::TYPE_COLOR) {
					$attributeName = 'propertyColor';
				} elseif($property->type == Property::TYPE_TAG) {
					$attributeName = 'propertyTag';
				} elseif($property->type == Property::TYPE_SIZE) {
					$attributeName = 'propertySize';
				}
				if(isset($attributeName)) {
					$page->$attributeName = $property->values;
					$page->$attributeName->property_title = $property->title;
					unset($productProperties[$key]);
				}
			}
		}

		return view('product', compact('page', 'productReviews', 'viewed', 'productProperties'));
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

		$siteTitle = $settings->get('siteTitle');
		$siteLogo = $settings->get('logo.main');
		$content = \View::make('sitemapXml', compact('sitemapItems', 'siteTitle', 'siteLogo'))->render();

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
					'message' => 'Письмо не отправлено. Исправьте ошибки.',
					'errors' => $validator->errors()
				]);
			}

			if($letter = Letter::create($data)) {
				
				Notification::forAllUsers(Notification::TYPE_NEW_LETTER, [
					'[linkToLetter]' => route('admin.letters.show', ['id' => $letter->id]),
					'[letterFromEmail]' => $letter->email,
					'[letterFromName]' => $letter->name,
					'[letterSubject]' => $letter->subject,
					'[letterText]' => $letter->message,
					'[letterCreatedAt]' => $letter->created_at,
				]);

				return \Response::json([
					'success' => true,
					'message' => 'Ваше письмо успешно отправлено!',
				]);
			}
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
					'message' => 'Запрос не отправлен. Исправьте ошибки.',
					'errors' => $validator->errors()
				]);
			}

			if($call = RequestedCall::create($data)) {
				Notification::forAllUsers(Notification::TYPE_NEW_REQUESTED_CALL, [
					'[linkToCall]' => route('admin.calls.edit', ['id' => $call->id]),
					'[userName]' => $call->name,
					'[userPhone]' => $call->phone,
				]);

				return \Response::json([
					'success' => true,
					'message' => 'Ваш запрос успешно отправлен! Менеджер свяжется с вами в течение рабочего дня call-центра.',
				]);
			}
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