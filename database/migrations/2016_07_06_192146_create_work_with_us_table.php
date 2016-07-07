<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkWithUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('work_with_us', function (Blueprint $table) {
			$table->increments('id');
			$table->boolean('is_published')->default(1);
			$table->string('title', 500);
			$table->string('image');
			$table->timestamps();
			$table->timestamp('published_at')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('work_with_us');
	}
}
