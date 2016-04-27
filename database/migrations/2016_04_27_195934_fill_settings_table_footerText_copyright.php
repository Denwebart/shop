<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableFooterTextCopyright extends Migration
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
				'key' => 'footerText',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Текст в футере',
				'description' => 'Текст в футере.',
				'value' => '',
				'is_active' => 1,
			],
			[
				'key' => 'copyright',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_TEXT,
				'title' => 'Копирайт',
				'description' => 'Копирайт.',
				'value' => '© 2016 Все права защищены.',
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
			'footerText',
			'copyright',
		])->delete();
	}
}
