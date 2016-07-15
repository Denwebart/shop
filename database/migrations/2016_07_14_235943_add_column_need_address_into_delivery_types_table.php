<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNeedAddressIntoDeliveryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('delivery_types', function (Blueprint $table) {
			$table->boolean('need_address')->default(1);
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
			$table->dropColumn('need_address');
		});
	}
}
