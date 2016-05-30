<?php
/**
 * Class Wishlist
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Wishlist;

use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class Wishlist extends BaseController
{
	protected $onPage = 15;
	protected $maxItems = 45;


	public function show()
	{
		$request = new Request();
		$products = $this->getWishlist(null, $request);

		return view('widget.wishlist::wishlist', compact('products'));
	}

	public function addToWishlist(Request $request)
	{
		if($request->ajax()) {

			$product = Product::find($request->get('id'));
			if(is_object($product)) {

				$result = $this->addProduct($request, $product);
				$products = $result['products'];
				if($result['new']) {
					$productsHtml = $this->getWishlist($products, $request);

					return \Response::json([
						'success' => true,
						'message' => 'Продукт успешно добавлен в <a href="' . route('wishlist.index') . '">список желаний</a>!',
						'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $productsHtml)->render(),
					])->withCookie(cookie()->forever('wishlist', $products));
				} else {
					return \Response::json([
						'success' => false,
						'message' => 'Продукт уже был добавлен в <a href="' . route('wishlist.index') . '">список желаний</a>, мы перенесли его в начало списка.'
					])->withCookie(cookie()->forever('wishlist', $products));
				}
			} else {
				return \Response::json([
					'success' => false,
					'message' => 'Произошла ошибка, товар не был добавлен в <a href="' . route('wishlist.index') . '">список желаний</a>.'
				]);
			}
		}
	}

	public function removeFromWishlist(Request $request)
	{
		if($request->ajax()) {

			$products = $request->cookie('wishlist', []);
			unset($products[$request->get('key')]);

			$productsHtml = $this->getWishlist($products, $request);

			$response = \Response::json([
				'success' => true,
				'wishlistProductsHtml' => view('widget.wishlist::products')->with('products', $productsHtml)->render(),
				'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $productsHtml)->render(),
				'pageUrl' => $productsHtml->url($productsHtml->currentPage()),
				'count' => count($productsHtml),
			]);

			return $response->withCookie(cookie()->forever('wishlist', $products));
		}
	}

	public function removeAll(Request $request)
	{
		if($request->ajax()) {

			$products = [];
			$productsHtml = $this->getWishlist($products, $request);

			$response = \Response::json([
				'success' => true,
				'wishlistProductsHtml' => view('widget.wishlist::products')->with('products', $productsHtml)->render(),
				'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $productsHtml)->render(),
				'pageUrl' => $productsHtml->url(1),
			]);

			return $response->withCookie(cookie()->forget('wishlist'));
		}
	}

	public function getWishlist($products = null, Request $request)
	{
		if(is_null($products)) {
			$products = \Request::cookie('wishlist', []);
		}

		foreach ($products as $productId => $item) {
			$productsIds[] = $productId;
		}

		if(isset($productsIds)) {
			$productModels = Product::whereIn('id', $productsIds)
				->whereIsPublished(1)
				->where('published_at', '<=', Carbon::now())
				->with([
					'category' => function($q) {
						$q->select(['id', 'parent_id', 'alias', 'type']);
					}
				])->get(['id', 'category_id', 'alias', 'title', 'image', 'image_alt', 'price']);

			foreach($productModels as $productModel) {
				$products[$productModel->id]['product'] = $productModel;
			}
		}
		
		$products = array_reverse($products, true);

		$page = $request->get('page', 1);
		if($request->ajax() && ((count($products) % $this->onPage) < 1)) {
			$page = $request->get('page') - 1;
		}
		$offSet = ($page * $this->onPage) - $this->onPage;
		
		$itemsForCurrentPage = array_slice($products, $offSet, $this->onPage, true);
		
		$products = new LengthAwarePaginator($itemsForCurrentPage, count($products), $this->onPage, $page);
		$pageUrl = $request->has('url') ? $request->get('url') : $request->url();
		$params = $request->except(['url', 'key']);
		if($products->lastPage() != $products->currentPage()) {
			$params['page'] = $page;
		}
		$products->setPath($pageUrl)->appends($params);
		return $products;
	}

	/**
	 * Add product to wishlist with session
	 *
	 * @param Request $request
	 * @param $product
	 * @return bool or array with products
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function addProduct(Request $request, $product)
	{
		$products = $request->cookie('wishlist', []);

		$isNew = !array_key_exists($product->id, $products);
		if($isNew) {
			if(count($products) >= $this->maxItems) {
				reset($products);
				$first = key($products);
				unset($products[$first]);
			}
		} else {
			unset($products[$product->id]);
		}
		$products[$product->id] = [
			'at' => date('Y-m-d H:i:s'),
		];
		return [
			'products' => $products,
			'new' => $isNew ? true : false,
		];
	}

}