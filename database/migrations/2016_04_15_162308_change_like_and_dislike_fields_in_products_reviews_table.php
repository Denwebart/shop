<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLikeAndDislikeFieldsInProductsReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('products_reviews', function ($table) {
		    $table->integer('like')->default(0)->change();
		    $table->integer('dislike')->default(0)->change();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('products_reviews', function ($table) {
		    $table->integer('like')->change();
		    $table->integer('dislike')->change();
	    });
    }
}
