<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsTypeValueIntoPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('properties', function (Blueprint $table) {
			$table->tinyInteger('type')->default(0);
			$table->string('value')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('properties', function (Blueprint $table) {
			$table->dropColumn('type');
			$table->dropColumn('value');
		});
	}
}
