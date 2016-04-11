<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('products_reviews', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('parent_id')->default(0);
			$table->integer('product_id');
			$table->string('user_name', 100);
			$table->string('user_email', 100);
			$table->text('text');
			$table->timestamps();
			$table->timestamp('published_at')->nullable();
			$table->boolean('is_published')->default(1);
			$table->tinyInteger('rating')->nullable();
			$table->integer('like');
			$table->integer('dislike');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('products_reviews');
    }
}
