<?php
/**
 * Class MenusController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Modules\Admin\Controllers;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Validator;
use Illuminate\View\View;

class MenusController extends Controller
{
	/**
	 * Get menu items array in Json format
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function getJsonMenuItems(Request $request)
	{
		if($request->ajax()) {
			$items = [];
			foreach(Menu::getMenuItems($request->get('type')) as $key => $item) {
				$valueArray = [
					'id' => $item->id,
					'parent' => $item->parent_id ? $item->parent_id : "#",
					'text' => $item->page->getTitle(),
					'children' => count($item->children) ? true : false
				];
				if($request->get('type')) {
					$items[] = $valueArray;
				} else {
					$items[$item->type][] = $valueArray;
				}
			}

			return \Response::json([
				'items' => json_encode($items, JSON_UNESCAPED_UNICODE)
			]);
		}
	}

	/**
	 * Rename menu item
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function rename(Request $request)
	{
		// доделать изменение заголовка меню для других пунктов меню (в других меню)
		if($request->ajax()) {
			$menu = Menu::find($request->get('pk'));

			if($menu && $menu->page) {
				$newMenuTitle = trim($request->get('value'));
				$validator = \Validator::make(['menu_title' => $newMenuTitle], ['menu_title' => 'required|max:50']);
				if($validator->fails()) {
					return \Response::json([
						'success' => false,
						'message' => 'Произошла ошибка, заголовок меню не изменен. Исправьте ошибки валидации.',
						'error' => $validator->errors()->first('menu_title'),
					]);
				}

				$menu->page->menu_title = $newMenuTitle;
				$menu->page->save();

				return \Response::json([
					'success' => true,
					'message' => 'Заголовок меню успешно изменен.',
					'pageId' => $menu->page->id,
				]);
			}

			return \Response::json([
				'success' => true,
				'message' => 'Произошла ошибка, заголовок меню не изменен.'
			]);
		}
	}

	/**
	 * Delete menu item
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function delete(Request $request)
	{
		if($request->ajax()) {
			$menu = Menu::whereId($request->get('itemId'))
				->whereType($request->get('menuType'))
				->first();

			if(is_object($menu) && $menu->delete()) {

				$items = Menu::getMenuItems($request->get('menuType'));

				return \Response::json([
					'success' => true,
					'message' => 'Пункт меню успешно удалён.',
					'menuItemsHtml' => view('admin::menus.items', compact('items'))
						->with('menuType', $request->get('menuType'))->render(),
				]);
			}

			return \Response::json([
				'success' => true,
				'message' => 'Произошла ошибка, пункт меню не удалён'
			]);
		}
	}

	/**
	 * Change position of menu items
	 *
	 * @param Request $request
	 * @return mixed
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function changePosition(Request $request)
	{
		$positions = $request->get('positions');
		$i = 0;
		foreach($positions as $itemId) {
			$menu = Menu::find($itemId);
			$menu->position = $i;
			$menu->save();
			$i++;
		}
		return \Response::json(array(
			'success' => true,
			'message' => 'Позиция пункта меню изменена.',
		));
	}
}
