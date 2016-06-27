<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('users_settings', function (Blueprint $table) {
		    $table->integer('user_id');
		    $table->boolean('permission_letters')->default(1);
		    $table->boolean('permission_products_reviews')->default(1);
		    $table->boolean('permission_shop_reviews')->default(1);
		    $table->boolean('permission_requested_calls')->default(1);
		    $table->boolean('permission_orders')->default(1);
		    $table->boolean('permission_products')->default(1);
		    $table->boolean('permission_pages')->default(1);
		    $table->boolean('permission_users')->default(0);
		    $table->boolean('permission_settings')->default(0);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::drop('users_settings');
    }
}
