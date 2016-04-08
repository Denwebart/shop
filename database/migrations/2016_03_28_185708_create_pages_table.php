<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('alias', 500);
			$table->integer('parent_id')->default(0);
			$table->integer('user_id');
			$table->tinyInteger('type')->default(1);
			$table->boolean('is_published')->default(1);
			$table->boolean('is_container')->default(0);
			$table->string('title', 500);
			$table->string('menu_title', 100);
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
		Schema::drop('pages');
	}
}
