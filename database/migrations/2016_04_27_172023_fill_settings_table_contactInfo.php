<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableContactInfo extends Migration
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
				'key' => 'contactInfo.address',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Адрес',
				'description' => 'Адрес магазина.',
				'value' => '',
				'is_active' => 1,
			],
			[
				'key' => 'contactInfo.phones',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Телефоны',
				'description' => 'Телефоны.',
				'value' => '',
				'is_active' => 1,
			],
			[
				'key' => 'contactInfo.email',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Email',
				'description' => 'Адрес электронной почты.',
				'value' => '',
				'is_active' => 1,
			],
			[
				'key' => 'contactInfo.skype',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Skype',
				'description' => 'Логин в skype.',
				'value' => '',
				'is_active' => 1,
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
			'contactInfo.address',
			'contactInfo.phones',
			'contactInfo.email',
			'contactInfo.skype',
		])->delete();
	}
}
