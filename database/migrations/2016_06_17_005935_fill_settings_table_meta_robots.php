<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableMetaRobots extends Migration
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
				'key' => 'meta.robots',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Robots',
				'description' => "Указывает поисковым роботам, 
								можно ли индексировать данную страницу 
								и можно ли использовать ссылки, приведенные на странице. \n
								Если значение не активно или пусто - сайт выключен для индексирования.",
				'value' => 'noindex,nofollow',
				'is_active' => 1,
				'validation_rule' => 'max:255',
			],
			[
				'key' => 'meta.author',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Author',
				'description' => "Служит для идентификации автора или принадлежности документа. \n
								Может содержать имя автора сайта.\n
								Как правило, не использутся вместе с мета-тегом Copyright.",
				'value' => '',
				'is_active' => 0,
				'validation_rule' => 'max:255',
			],
			[
				'key' => 'meta.copyright',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Copyright',
				'description' => "Служит для идентификации автора или принадлежности документа. \n
								Может содержать название организации или авторские права. 
								Если сайт принадлежит какой-либо организации, 
								целесообразнее использовать тег Copyright. \n
								Как правило, не использутся вместе с мета-тегом Author.",
				'value' => '',
				'is_active' => 0,
				'validation_rule' => 'max:255',
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
			'meta.robots',
			'meta.author',
			'meta.copyright',
		])->delete();
	}
}
