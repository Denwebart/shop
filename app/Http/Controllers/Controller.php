<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Widgets\Menu\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Helpers\CurrencyRate;
use App\Helpers\SettingsController;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function __construct(CurrencyRate $course, SettingsController $settings)
	{
		\View::share('siteSettings', $settings->getCategory(Setting::CATEGORY_SITE));
		\View::share('courseUSD', $course->getCourse());
		\View::share('menuWidget', new Menu());
	}
}
