<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeForSettingAddressPhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('settings')->whereIn('key', ['contactInfo.phones', 'contactInfo.address'])
		    ->update(['type' => \App\Models\Setting::TYPE_TEXT]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('settings')->whereIn('key', ['contactInfo.phones', 'contactInfo.address'])
		    ->update(['type' => \App\Models\Setting::TYPE_STRING]);
    }
}
