<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableLatitudeLongitude extends Migration
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
				'key' => 'map.latitude',
				'category' => \App\Models\Setting::CATEGORY_CONTACT_PAGE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Широта',
				'description' => 'Координаты для катры. Широта.',
				'value' => null,
				'is_active' => 1,
				'validation_rule' => 'regex:/^[-+]?[0-9\.]+$/u',
			],
			[
				'key' => 'map.longitude',
				'category' => \App\Models\Setting::CATEGORY_CONTACT_PAGE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Долгота',
				'description' => 'Координаты для катры. Долгота.',
				'value' => null,
				'is_active' => 1,
				'validation_rule' => 'regex:/^[-+]?[0-9\.]+$/u',
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
			'map.latitude',
			'map.longitude',
		])->delete();
	}
}
