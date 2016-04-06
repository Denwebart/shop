<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('discounts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 200);
			$table->string('description', 2500);
			$table->decimal('value', 12, 2);
			$table->tinyInteger('type')->default(1);
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
		Schema::drop('discounts');
	}
}
