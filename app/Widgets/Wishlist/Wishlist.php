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

class Wishlist extends BaseController
{
	public function show()
	{
		$products = \Session::get('wishlist', []);

		return view('widget.wishlist::wishlist', compact('products'));
	}
	
	public function addToWishlist(Request $request)
	{
		if($request->ajax()) {

			$product = Product::find($request->get('id'));
			if(is_object($product)) {

				if($this->addProduct($request, $product)) {
					$products = \Session::get('wishlist', []);

					return \Response::json([
						'success' => true,
						'message' => 'Продукт успешно добавлен в список желаний!',
						'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $products)->render(),
					]);
				} else {
					return \Response::json([
						'success' => false,
						'message' => 'Продукт уже добавлен в список желаний.'
					]);
				}

			}

			return \Response::json([
				'success' => false,
				'message' => 'Произошла ошибка, товар не был добавлен в список желаний.'
			]);
		}
	}

	public function removeFromWishlist(Request $request)
	{
		if($request->ajax()) {

			$this->deleteProduct($request);

			$products = $this->getWishlist();

			return \Response::json([
				'success' => true,
				'wishlistProductsHtml' => view('widget.wishlist::products')->with('products', $products)->render(),
				'wishlistHtml' => view('widget.wishlist::wishlist')->with('products', $products)->render(),
			]);
		}
	}

	public function getWishlist()
	{
		$products = \Session::get('wishlist', []);

		foreach ($products as $productId => $item) {
			$productsIds[] = $productId;
		}

		if(isset($productsIds)) {
			$productModels = Product::whereIn('id', $productsIds)
				->whereIsPublished(1)
				->where('published_at', '<', Carbon::now())
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
	 * @return bool
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function addProduct(Request $request, $product)
	{
		$products = $request->session()->get('wishlist', []);

		if(!array_key_exists($product->id, $products)) {
			$products[$product->id] = [
				'product_id' => $product->id,
				'added_at' => Carbon::now(),
			];

			$request->session()->put('wishlist', $products);
			return true;
		}

		return false;
	}

	/**
	 * Delete product from wishlist session
	 *
	 * @param Request $request
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	protected function deleteProduct(Request $request)
	{
		$products = $request->session()->get('wishlist', []);
		unset($products[$request->get('id')]);

		$request->session()->put('wishlist', $products);
	}
}