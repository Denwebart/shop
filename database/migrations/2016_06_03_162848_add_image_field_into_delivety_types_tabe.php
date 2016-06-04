<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageFieldIntoDelivetyTypesTabe extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('delivery_types', function (Blueprint $table) {
			$table->string('image')->nullable();
			$table->string('is_active')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('delivery_types', function (Blueprint $table) {
			$table->dropColumn('image');
			$table->dropColumn('is_active');
		});
	}
}
