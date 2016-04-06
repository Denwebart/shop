<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersDeliveryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('orders_delivery_types', function (Blueprint $table) {
			$table->integer('order_id');
			$table->integer('delivery_type_id');
			$table->string('address', 500);
			$table->primary('order_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders_delivery_types');
	}
}
