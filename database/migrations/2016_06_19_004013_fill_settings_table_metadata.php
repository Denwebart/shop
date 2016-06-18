<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableMetadata extends Migration
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
				'key' => 'meta.title',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Title',
				'description' => "Самый важный SEO-тег.\n
								Заголовок сайта или отдельной страницы,
								является самым важным фактором при ранжировании в поисковых системах.\n
								Рекомендуемая длина - 65 символов.",
				'value' => null,
				'is_active' => 0,
				'validation_rule' => 'max:300',
			],
			[
				'key' => 'meta.description',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Description',
				'description' => "Краское описание страницы,
								используется поисковыми системами для индексации, 
								а также при создании аннотации в выдаче по запросу.\n
								Рекомендуемая длина - 160 символов.",
				'value' => null,
				'is_active' => 0,
				'validation_rule' => 'max:300',
			],
			[
				'key' => 'meta.keywords',
				'category' => \App\Models\Setting::CATEGORY_SITE,
				'type' => \App\Models\Setting::TYPE_STRING,
				'title' => 'Мета-тег Keywords',
				'description' => "Необязательный SEO-тег. Содержит список ключевых слов, 
								через запятую, которые употреблены при написании страницы. \n
								Рекомендуемая длина - 150-250 символов.",
				'value' => null,
				'is_active' => 0,
				'validation_rule' => 'max:300',
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
			'meta.title',
			'meta.description',
			'meta.keywords',
		])->delete();
	}
}
