<?php
/**
 * Class Carousel
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Carousel;

use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyValue;
use App\Models\WorkWithUs;

class Carousel
{
	/**
	 * Best salles products
	 *
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function sale()
	{
		return \Cache::rememberForever('widgets.carousel.sale', function() {
			$title = 'Распродажа';
			
			// доделать сортировать по скидкам
			$items = Product::select(\DB::raw('products.id, products.vendor_code, products.category_id, products.alias, products.is_published, products.title, products.price, products.image, products.image_alt, products.published_at, count(orders_products.product_id) as `boughtTimes`'))
				->leftJoin('orders_products', 'products.id', '=', 'orders_products.product_id')
				->where('products.is_published', '=', 1)
				->with([
					'category' => function($q) {
						$q->select(['id', 'parent_id', 'alias', 'type']);
					},
					'category.parent' => function($q) {
						$q->select(['id', 'parent_id', 'alias', 'type']);
					},
					'propertyColor'
				])
				->groupBy('orders_products.product_id')
//			->orderBy('boughtTimes', 'ASC')
//			->orderBy('products.published_at', 'DESC')
				->limit(12)
				->get();
			
			return view('widget.carousel::index', compact('items', 'title'))->render();
		});
	}

	/**
	 * Product brands
	 *
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function brands()
	{
		$title = 'С нами сотрудничают';

		$items = PropertyValue::select(\DB::raw('property_values.id, property_values.property_id, property_values.value as title, property_values.additional_value'))
			->leftJoin('properties', 'property_values.property_id', '=', 'properties.id')
			->where('properties.type', '=', Property::TYPE_BRAND)
			->whereNotNull('property_values.additional_value')
			->where('property_values.additional_value', '!=', '')
			->with('property')
			->orderBy('property_values.id', 'DESC')
			->get();

		return view('widget.carousel::brands', compact('items', 'title'));
	}

	/**
	 * Work with us
	 *
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function workWithUs()
	{
		return \Cache::rememberForever('widgets.carousel.workWithUs', function() {
			$title = 'С нами сотрудничают';
			
			$items = WorkWithUs::whereIsPublished(1)
				->orderBy('published_at', 'DESC')
				->get();
			
			return view('widget.carousel::brands', compact('items', 'title'))->render();
		});
	}
}