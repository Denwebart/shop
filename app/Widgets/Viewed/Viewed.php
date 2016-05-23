<?php
/**
 * Class Viewed
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Viewed;

use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;

class Viewed extends BaseController
{
	protected $limit = 3;

	public function show($productId = null)
	{
		$title = 'Недавно просмотренные';

		$products = $this->get();

		if($productId) {
			$products = $this->add($productId);
		}

		return view('widget.viewed::index', compact('products', 'title'));
	}

	public function add($productId)
	{
		$product = Product::find($productId);
		if(is_object($product)) {

			$products = \Request::cookie('viewed', []);

			if(array_key_exists($product->id, $products)) {
				unset($products[$product->id]);
			}

			$products[$product->id] = [
				'product_id' => $product->id,
				'added_at' => Carbon::now(),
				'product' => null,
			];

			return $products;

//			$response->withCookie(cookie()->forever('viewed', $products));
		}
	}

	public function get($products = null)
	{
		if(is_null($products)) {
			$products = \Request::cookie('viewed', []);
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

}