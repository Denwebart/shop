<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTextAlignFieldIntoSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('slider', function (Blueprint $table) {
			$table->tinyInteger('text_align')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('slider', function (Blueprint $table) {
			$table->dropColumn('text_align');
		});
	}
}
