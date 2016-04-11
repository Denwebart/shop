<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('letters', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('subject', 500)->nullable();
			$table->text('message');
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
		Schema::drop('letters');
	}
}
