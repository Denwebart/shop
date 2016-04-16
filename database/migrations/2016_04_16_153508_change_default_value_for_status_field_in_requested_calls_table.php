<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValueForStatusFieldInRequestedCallsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('requested_calls', function (Blueprint $table) {
			$table->dropColumn('status');
		});
		Schema::table('requested_calls', function ($table) {
			$table->tinyInteger('status')->default(0)->after('phone');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('requested_calls', function (Blueprint $table) {
			$table->dropColumn('status');
		});
		Schema::table('requested_calls', function ($table) {
			$table->tinyInteger('status')->nullable()->after('phone');
		});
	}
}
