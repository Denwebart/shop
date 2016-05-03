<?php
/**
 * Class Carousel
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */


namespace App\Widgets\Carousel;


use App\Models\Product;

class Carousel
{
	public function sale()
	{
		$title = 'Распродажа';
		
		// доделать сортировать по скидкам
		$items = Product::select(\DB::raw('products.id, products.vendor_code, products.category_id, products.alias, products.is_published, products.title, products.price, products.image, products.image_alt, products.published_at, count(orders_products.product_id) as `boughtTimes`'))
			->leftJoin('orders_products', 'products.id', '=', 'orders_products.product_id')
			->where('products.is_published', '=', 1)
			->with('category', 'category.parent')
			->groupBy('orders_products.product_id')
//			->orderBy('boughtTimes', 'ASC')
//			->orderBy('products.published_at', 'DESC')
			->limit(12)
			->get();

		return view('widget.carousel::index', compact('items', 'title'));
	}
}