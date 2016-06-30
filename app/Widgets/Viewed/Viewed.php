<?php
/**
 * Class Viewed
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Viewed;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;

class Viewed extends BaseController
{
	protected $limit = 12;

	/**
	 * Show last viewed widget
	 *
	 * @param $productId
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function show($productId)
	{
		$title = 'Недавно просмотренные';

		$products = $this->get();

		return view('widget.viewed::index', compact('products', 'title', 'productId'));
	}

	/**
	 * Add products to last viewed (cookie)
	 *
	 * @param Request $request
	 * @return $this
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function add(Request $request)
	{
		if($request->ajax()) {
			$product = Product::find($request->get('id'));
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

				$products = array_slice($products, -$this->limit, null, true);

				$response = \Response::json([
					'success' => true,
				]);

				return $response->withCookie(cookie()->forever('viewed', $products));
			}
		}
	}

	/**
	 * Get products from last viewed (cookie)
	 *
	 * @param null $products
	 * @return array
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function get($products = null)
	{
		if(is_null($products)) {
			$products = \Request::cookie('viewed', []);
		}

		foreach ($products as $productId => $item) {
			$productsIds[] = $item['product_id'];
		}

		if(isset($productsIds)) {
			$productModels = Product::whereIn('id', $productsIds)
				->whereIsPublished(1)
				->where('published_at', '<=', Carbon::now())
				->with([
					'category' => function($q) {
						$q->select(['id', 'parent_id', 'alias', 'type']);
					},
					'category.parent' => function($q) {
						$q->select(['id', 'parent_id', 'alias', 'type']);
					},
					'propertyColor'
				])->get(['id', 'category_id', 'alias', 'title', 'image', 'image_alt', 'price']);

			foreach($productModels as $productModel) {
				$products[$productModel->id]['product'] = $productModel;
			}
		}

		return array_reverse($products, true);
	}

}