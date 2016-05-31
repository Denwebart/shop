<?php
/**
 * Class Articles
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Articles;

use App\Models\Page;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Product;

class Articles extends BaseController
{
	protected $limit = 3;

	public $title = 'Новости';

	/**
	 * Show last viewed widget
	 *
	 * @param $parentId
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function show($parentId)
	{
		$title = $this->title;

		$pages = Page::whereParentId($parentId)
			->whereIsPublished(1)
			->where('published_at', '<', date('Y-m-d H:i:s'))
			->with([
				'parent' => function($q) {
					$q->select(['id', 'type', 'is_container', 'alias']);
				}
			])
			->orderBy('published_at', 'DESC')
			->limit($this->limit)
			->get(['id', 'parent_id', 'alias', 'type', 'is_container', 'title', 'introtext', 'content', 'is_published', 'published_at']);

		return view('widget.articles::index', compact('pages', 'title'));
	}

}