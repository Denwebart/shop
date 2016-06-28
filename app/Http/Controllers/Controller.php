<?php

namespace App\Http\Controllers;

use App\Helpers\Settings;
use App\Models\Setting;
use App\Widgets\Cart\Cart;
use App\Widgets\Menu\Menu;
use App\Widgets\Wishlist\Wishlist;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Helpers\CurrencyRate;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function __construct(CurrencyRate $course, Settings $settings)
	{
		\View::share('siteSettings', $settings->getCategory(Setting::CATEGORY_SITE));
		\View::share('courseUSD', number_format($course->getCourse(), 2, '.', ' '));
		\View::share('menuWidget', new Menu());
		\View::share('cartWidget', new Cart());
		\View::share('wishlistWidget', new Wishlist($course, $settings));
	}
}
