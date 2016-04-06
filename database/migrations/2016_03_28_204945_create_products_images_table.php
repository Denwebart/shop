<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('products_images', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->string('image');
			$table->string('image_alt', 700)->nullable();
			$table->tinyInteger('position')->default(0);
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products_images');
	}
}
