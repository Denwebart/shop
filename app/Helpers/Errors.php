<?php
/**
 * Class Errors
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

use App\Models\Page;
use App\Modules\Admin\Widgets\Badge;
use Illuminate\Http\Request;

class Errors
{
	/**
	 * Ошибка 403
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function error403(Request $request)
	{
		if(!$request->ajax()) {
			$page = new Page();
			$page->code = "403";
			$page->icon = "fa-lock";
			$page->title = "Недостаточно прав доступа.";
			$page->content = "У Вас недостаточно прав для просмотра этой страницы.";
			\View::share('page', $page);
			
			$badge = new Badge();
			\View::share('badge', $badge);
			
			return \Response::view('admin::admin.error');
		} else {
			return \Response::json([
				'success' => 'false',
				'message' => 'Недостаточно прав для сорершения действия.'
			]);
		}
	}
	
	/**
	 * Ошибка 404
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
	 *
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public static function error404(Request $request)
	{
		$page = new Page();
		$page->code = "404";
		$page->icon = "fa-spinner fa-spin";
		$page->menu_title = "Ошибка 404";
		$page->title = "Страница не найдена.";
		$page->content = "Запрашиваемая страница не найдена.";
		
		\View::share('page', $page);
		
		if(!$request->is('admin*')) {
			// фронт
			$course = new CurrencyController();
			$settings = new Settings();
			\View::share('siteSettings', $settings->getCategory(Setting::CATEGORY_SITE));
			\View::share('courseUSD', $course->getCourse());
			\View::share('menuWidget', new Menu());
			\View::share('cartWidget', new Cart());
			\View::share('wishlistWidget', new Wishlist());
			\View::share('articlesWidget', new Articles());
			
			return \Response::view('errors.404');
		} else {
			// админка
			$badge = new Badge();
			\View::share('badge', $badge);
			
			return \Response::view('admin::admin.error');
		}
	}
}