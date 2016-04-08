<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('settings', function (Blueprint $table) {
		    $table->increments('id');
		    $table->string('key', 100)->unique();
		    $table->tinyInteger('category')->default(1);
		    $table->boolean('type');
		    $table->string('title', 100);
		    $table->string('description', 500)->nullable();
		    $table->string('value', 500)->nullable();
		    $table->boolean('is_active');
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
		Schema::drop('settings');
	}
}
