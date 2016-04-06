<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('products_history', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->decimal('price', 12, 2);
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
		Schema::drop('products_history');
	}
}
