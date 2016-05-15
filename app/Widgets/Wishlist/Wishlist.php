<?php
/**
 * Class Wishlist
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Wishlist;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Wishlist extends BaseController
{
	public function show()
	{
		$products = \Request::cookie('wishlist', []);

		return view('widget.wishlist::wishlist', compact('products'));
	}
	
	public function addToWishlist(Request $request)
	{
		if($request->ajax()) {

			$product = Product::find($request->get('id'));
			if(is_object($product)) {

				$products = $this->addProduct($request, $product);
				if($products) {
					$response = \Response::json([
						'success' => true,
						'message' => 'Продукт успешно добавлен в <a href="' . route('wishlist.index') . '">список желаний</a>!',
						'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $products)->render(),
					]);
					return $response->withCookie(cookie()->forever('wishlist', $products));
				} else {
					return \Response::json([
						'success' => false,
						'message' => 'Продукт уже добавлен в <a href="' . route('wishlist.index') . '">список желаний</a>.'
					]);
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
			unset($products[$request->get('id')]);

			$products = $this->getWishlist($products);
//			var_dump($products);

//			$response = \Response::json([
//				'success' => true,
//				'wishlistProductsHtml' => view('widget.wishlist::products')->with('products', $products)->render(),
//				'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $products)->render(),
//			]);

//			return $response->withCookie(cookie()->forever('wishlist', $products));

//			var_dump(\Cookie::forget('wishlist'));
//			dd(\Cookie::forever('wishlist', $products));

			return response()->json([
				'success' => true,
				'wishlistProductsHtml' => view('widget.wishlist::products')->with('products', $products)->render(),
				'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $products)->render(),
			])->withCookie(cookie()->forever('wishlist', $products));
		}
	}

	public function getWishlist($products = null)
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

		return array_reverse($products, true);
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

		if(!array_key_exists($product->id, $products)) {
			$products[$product->id] = [
				'product_id' => $product->id,
				'added_at' => Carbon::now(),
			];
			return $products;
		}

		return false;
	}

}