<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('customer_id');
			$table->integer('coupon_id')->nullable();
			$table->decimal('total_price', 12, 2);
			$table->tinyInteger('status');
			$table->timestamps();
			$table->timestamp('paid_at')->nullable();
			$table->timestamp('closed_at')->nullable();
			$table->tinyInteger('payment_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}
}
