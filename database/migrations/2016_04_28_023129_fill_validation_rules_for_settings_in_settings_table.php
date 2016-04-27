<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillValidationRulesForSettingsInSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('settings')->where('key', 'LIKE', 'socialButtons.%')
		    ->update(['validation_rule' => 'url|max:250']);
	    DB::table('settings')->whereIn('key', [
		    'contactInfo.address',
		    'contactInfo.phones',
		    'contactInfo.skype',
		    'siteTitle',
	    ])->update(['validation_rule' => 'max:250']);
	    DB::table('settings')->whereIn('key', ['contactInfo.email'])
		    ->update(['validation_rule' => 'email|max:250']);
	    DB::table('settings')->whereIn('key', [
		    'footerText',
		    'copyright',
	    ])->update(['validation_rule' => 'max:500']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('settings')->update(['validation_rule' => '']);
    }
}
