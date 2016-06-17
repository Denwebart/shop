<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsTypeValueIntoPropertyValuesTableRemoveFromPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('property_values', function (Blueprint $table) {
			$table->string('additional_value')->nullable();
		});
		Schema::table('properties', function (Blueprint $table) {
			$table->dropColumn('value');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('property_values', function (Blueprint $table) {
			$table->dropColumn('additional_value');
		});
		Schema::table('properties', function (Blueprint $table) {
			$table->string('value')->nullable();
		});
	}
}
