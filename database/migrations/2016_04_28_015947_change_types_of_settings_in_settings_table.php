<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypesOfSettingsInSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		DB::table('settings')->where('key', '!=', 'footerText')->update(['type' => \App\Models\Setting::TYPE_STRING]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('settings')->update(['type' => \App\Models\Setting::TYPE_TEXT]);
	}
}
