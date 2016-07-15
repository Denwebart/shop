<?php
/**
 * Class View
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

/**
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

use App\Models\Page;

class View
{
	/**
	 * Get pages branch for sitemap
	 *
	 * @param object $model
	 * @param string $url
	 * @param int $level
	 * @param null $view
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function getChildrenPages($model, $url, $level = 1, $view = null)
	{
		// доделать: оптимизировать количество запросов, возможно выбирать одним запросом?
		if($model->is_container){
			$children = $model->publishedChildren()
				->get(['id', 'parent_id', 'type', 'is_container', 'alias', 'title', 'menu_title', 'updated_at', 'published_at']);
			
			if($model->type == Page::TYPE_CATALOG) {
				$products = $model->publishedProducts()
					->get(['id', 'category_id', 'alias', 'title', 'updated_at', 'published_at']);
			} else {
				$products = [];
			}
			
			if(!$view) {
				if(count($children) || count($products)) {
					echo '<ul class="level-' . $level . '">';
					++$level;
					foreach ($children as $item) {
						echo '<li>';
						echo \View::make('parts.listItem', compact('item', 'level'))->with('url', $url . '/' . $item->alias)->render();
						if ($item->is_container && (count($model->publishedChildren) || count($model->publishedProducts))) {
							self::getChildrenPages($item, $url . '/' . $item->alias, $level);
						}
						echo '</li>';
					}
					foreach ($products as $item) {
						echo '<li>';
						echo \View::make('parts.listItem', compact('item', 'level'))->with('url', $url . '/' . $item->alias)->render();
						echo '</li>';
					}
					echo '</ul>';
				}
			} elseif($view == 'xml') {
				if(count($children) || count($products)) {
					++$level;
					foreach ($children as $item) {
						echo \View::make('parts.xmlItem', compact('item', 'level'))->with('url', $url . '/' . $item->alias)->render();
						if ($item->is_container && (count($model->publishedChildren) || count($model->publishedProducts))) {
							self::getChildrenPages($item, $url . '/' . $item->alias, $level, 'xml');
						}
					}
					foreach ($products as $item) {
						echo \View::make('parts.xmlItem', compact('item', 'level'))->with('url', $url . '/' . $item->alias)->render();
					}
				}
			}
		}
	}
}