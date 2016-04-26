<?php
/**
 * Class Menu
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Widgets\Menu;

class Menu
{
	private $menuItems = [];

	public function __construct()
	{
		$allItems = \App\Models\Menu::whereParentId(0)
			->with([
				'page' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
				'children',
				'children.page' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
				'children.page.parent' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
			])->orderBy('position', 'ASC')->get();

		foreach ($allItems as $item) {
			$this->menuItems[$item->type][$item->id] = $item;
		}
	}

	/**
	 * Get menu items
	 *
	 * @param $type
	 * @return array|mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	private function getMenuItems($type)
	{
		return isset($this->menuItems[$type]) ? $this->menuItems[$type] : [];
	}

	public function main()
	{
		return view('widget.menu::main')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_MAIN));
	}

	public function product()
	{
		return view('widget.menu::product')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_PRODUCT));
	}

	public function bottomLeft()
	{
		return view('widget.menu::bottom')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_BOTTOM_LEFT));
	}

	public function bottomRight()
	{
		return view('widget.menu::bottom')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_BOTTOM_RIGHT));
	}

	public function info()
	{
		return view('widget.menu::info')
			->with('menuItems', $this->getMenuItems(\App\Models\Menu::TYPE_INFO));
	}

}