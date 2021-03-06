<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPriceIntoDeliveryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('delivery_types', function (Blueprint $table) {
			$table->decimal('price', 12, 2);
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
			$table->dropColumn('price');
		});
	}
}
