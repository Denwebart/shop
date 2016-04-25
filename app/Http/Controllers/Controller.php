<?php

namespace App\Http\Controllers;

use App\Widgets\Menu\Menu;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Helpers\CurrencyRate;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

	public function __construct(CurrencyRate $course)
	{
		\View::share('courseUSD', $course->getCourse());
		\View::share('menuWidget', new Menu());
	}
}
