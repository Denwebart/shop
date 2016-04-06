<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('products', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('vendor_code', 100)->unique();
		    $table->integer('category_id');
		    $table->integer('user_id');
		    $table->string('alias', 500);
		    $table->boolean('is_published')->default(1);
		    $table->string('title', 500);
		    $table->decimal('price', 12, 2);
		    $table->string('image')->nullable();
		    $table->string('image_alt', 700)->nullable();
		    $table->text('introtext');
		    $table->text('content');
		    $table->timestamps();
		    $table->timestamp('published_at')->nullable();
		    $table->string('meta_title', 600);
		    $table->string('meta_desc', 600);
		    $table->string('meta_key', 600);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('products');
    }
}
