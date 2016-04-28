<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('reviews', function (Blueprint $table) {
		    $table->increments('id');
		    $table->boolean('is_published')->default(1);
		    $table->string('user_name', 100);
		    $table->string('user_email', 100)->nullable();
		    $table->string('user_avatar', 100);
		    $table->string('text', 1000);
		    $table->timestamp('published_at')->nullable();
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('reviews');
    }
}
