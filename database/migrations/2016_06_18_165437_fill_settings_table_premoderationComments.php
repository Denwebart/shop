<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTablePremoderationComments extends Migration
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
				'key'         => 'premoderation.productsReviews',
				'category'    => \App\Models\Setting::CATEGORY_SYSTEM,
				'type'        => \App\Models\Setting::TYPE_BOOLEAN,
				'title'       => 'Премодерация отзывов о товаре',
				'description' => "Если премодерация включена, отзыв о товаре отображается
									после решения администратора или менеджера.",
				'value'       => 0,
				'is_active'   => 1,
				'validation_rule' => 'boolean',
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
			'premoderation.productsReviews',
		])->delete();
	}
}
