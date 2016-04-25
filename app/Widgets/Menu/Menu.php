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
	public function main()
	{
		$menuItems = \App\Models\Menu::whereType(\App\Models\Menu::TYPE_MAIN)
			->whereParentId(0)
			->with([
				'page' => function($query) {
					$query->select('id', 'alias', 'is_container', 'parent_id', 'title', 'menu_title');
				},
			])
			->orderBy('position', 'ASC')
			->get();

		return view('widget.menu::main', compact('menuItems'));
	}

	public function product()
	{
		$menuItems = \App\Models\Menu::whereType(\App\Models\Menu::TYPE_PRODUCT)
			->whereParentId(0)
			->with([
				'page' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
				'parent',
				'parent.page' => function($query) {
					$query->select('id', 'alias', 'type', 'is_container', 'parent_id', 'title', 'menu_title');
				},
			])
			->orderBy('position', 'ASC')
			->get();

		return view('widget.menu::product', compact('menuItems'));
	}

	public function bottomLeft()
	{
		$menuItems = \App\Models\Menu::whereType(\App\Models\Menu::TYPE_BOTTOM_LEFT)
			->whereParentId(0)
			->with([
				'page' => function($query) {
					$query->select('id', 'alias', 'is_container', 'parent_id', 'title', 'menu_title');
				},
			])
			->orderBy('position', 'ASC')
			->get();

		return view('widget.menu::bottom', compact('menuItems'));
	}

	public function bottomRight()
	{
		$menuItems = \App\Models\Menu::whereType(\App\Models\Menu::TYPE_BOTTOM_RIGHT)
			->whereParentId(0)
			->with([
				'page' => function($query) {
					$query->select('id', 'alias', 'is_container', 'parent_id', 'title', 'menu_title');
				},
			])
			->orderBy('position', 'ASC')
			->get();

		return view('widget.menu::bottom', compact('menuItems'));
	}

	public function info()
	{
		$menuItems = \App\Models\Menu::whereType(\App\Models\Menu::TYPE_INFO)
			->whereParentId(0)
			->with([
				'page' => function($query) {
					$query->select('id', 'alias', 'is_container', 'parent_id', 'title', 'menu_title');
				},
			])
			->orderBy('position', 'ASC')
			->get();

		return view('widget.menu::info', compact('menuItems'));
	}

}