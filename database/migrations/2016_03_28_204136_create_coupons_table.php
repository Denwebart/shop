<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('coupons', function (Blueprint $table) {
			$table->increments('id');
			$table->string('code', 50);
			$table->string('description', 2500);
			$table->decimal('value', 12, 2);
			$table->tinyInteger('type')->default(1);
			$table->integer('quantity');
			$table->timestamp('date_start')->nullable();
			$table->timestamp('date_end')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('coupons');
	}
}
