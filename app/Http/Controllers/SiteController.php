<?php
/**
 * Class SiteController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Http\Controllers;


use App\Models\Page;
use App\Models\Product;
use App\Widgets\Carousel\Carousel;
use App\Widgets\Reviews\Reviews;
use App\Widgets\Slider\Slider;

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
	public function pageOneLevel(\Illuminate\Http\Request $request, $page)
	{
		return $this->renderPage($request, $page);
	}

	public function pageTwoLevel(\Illuminate\Http\Request $request, $parentOne, $page)
	{
		return $this->renderPage($request, $page);
	}

	public function pageThreeLevel(\Illuminate\Http\Request $request, $parentOne, $parentTwo, $page)
	{
		return $this->renderPage($request, $page);
	}

	public function pageFourLevel(\Illuminate\Http\Request $request, $parentOne, $parentTwo, $parentThree, $page)
	{
		return $this->renderPage($request, $page);
	}

	protected function renderPage($request, $page)
	{
		if($request->getUri() != $page->getUrl()) {
			abort(404);
		}
		if(is_a($page, 'App\Models\Page')) {
			if($page->type == Page::TYPE_CATALOG) {
				return view('catalog', compact('page'));
			} else {
				return view('page', compact('page'));
			}
		} else {
			$page->ratingInfo = $page->getRating();
			$page->rating = $page->ratingInfo['value'];
			$productReviews = $page->getReviews();
			return view('product', compact('page', 'productReviews'));
		}
	}
}