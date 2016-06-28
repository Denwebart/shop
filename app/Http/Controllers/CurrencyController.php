<?php
/**
 * Class CurrencyController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Http\Controllers;

use App\Helpers\CurrencyRate;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
	/**
	 * Change currency
	 *
	 * @param Request $request
	 * @param CurrencyRate $сurrencyRate
	 *
	 * @return $this
	 * @author     It Hill (it-hill.com@yandex.ua)
	 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
	 */
	public function change(Request $request, CurrencyRate $сurrencyRate)
	{
		$oldCurrency = $request->cookie('currency', 'RUB');
		$newCurrency = $request->get('currency', 'USD');

		$course = \Cache::has('course' . $newCurrency)
			? \Cache::get('course' . $newCurrency)
			: $сurrencyRate->getCourse($newCurrency);
		\Cache::forever('course' . $newCurrency, $course);

		return redirect()->back()->withCookie(cookie()->forever('currency', $newCurrency));
	}

}