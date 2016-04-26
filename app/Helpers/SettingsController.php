<?php
/**
 * Class SettingsController
 *
 * @author     It Hill (it-hill.com@yandex.ua)
 * @copyright  Copyright (c) 2015-2016 Website development studio It Hill (http://www.it-hill.com)
 */

namespace App\Helpers;

use App\Models\Setting;

class SettingsController
{
	public function get($key)
	{
		$setting = Setting::whereKey($key)->whereIsActive(1)->first();
		return $setting ? $setting : null;
	}

	public function getCategory($category)
	{
		// доделать (чтоб можно было записывать настройки без точки, т.е. без подкатегории)
		$settings = Setting::select(['id', 'key', 'category', 'value', 'is_active'])
			->whereCategory($category)
			->whereIsActive(1)
			->whereNotNull('value')
			->get();
		
		foreach ($settings as $setting) {
			$settingsLevel = explode('.', $setting->key);
			$result[$settingsLevel[0]][$settingsLevel[1]] = $setting;
		}
		return isset($result) ? $result : [];
	}

}