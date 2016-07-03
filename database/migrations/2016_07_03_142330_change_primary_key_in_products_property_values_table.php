<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePrimaryKeyInProductsPropertyValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('products_property_values', function (Blueprint $table) {
		    $table->dropPrimary(['product_id', 'property_value_id']);
	    });
	    Schema::table('products_property_values', function (Blueprint $table) {
		    $table->increments('id')->first();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('products_property_values', function (Blueprint $table) {
		    $table->dropColumn('id');
	    });
	    Schema::table('products_property_values', function (Blueprint $table) {
		    $table->primary(['product_id', 'property_value_id']);
	    });
    }
}
