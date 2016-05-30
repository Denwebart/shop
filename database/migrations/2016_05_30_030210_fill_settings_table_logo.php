<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableLogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		DB::table('settings')->insert([
			[
				'key' => 'logo.main',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_IMAGE,
				'title' => 'Логотип',
				'description' => 'Логотип вверху сайта.',
				'value' => 'logo-main.png',
				'is_active' => 1,
				'validation_rule' => 'image|max:3072',
			],
			[
				'key' => 'logo.mobile',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_IMAGE,
				'title' => 'Логотип для мобильных',
				'description' => 'Логотип, который отображается на устроствах, где разрешение экрана меньше чет 767px.',
				'value' => 'logo-mobile.png',
				'is_active' => 1,
				'validation_rule' => 'image|max:3072',
			],
			[
				'key' => 'logo.transparent',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_IMAGE,
				'title' => 'Логотип для мобильных',
				'description' => 'Логотип, который отображается на устроствах, где разрешение экрана меньше чет 767px.',
				'value' => 'logo-transparent.png',
				'is_active' => 1,
				'validation_rule' => 'image|max:3072',
			],
		]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('settings')->whereIn('key', [
			'logo.main',
			'logo.mobile',
			'logo.transparent',
		])->delete();
	}
}
