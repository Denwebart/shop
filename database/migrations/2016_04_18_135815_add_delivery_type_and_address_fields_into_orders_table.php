<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeliveryTypeAndAddressFieldsIntoOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('orders', function (Blueprint $table) {
			$table->string('address', 500)->after('payment_type');
			$table->integer('delivery_type')->after('payment_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function (Blueprint $table) {
			$table->string('address', 500);
			$table->dropColumn('delivery_type');
		});
	}
}
