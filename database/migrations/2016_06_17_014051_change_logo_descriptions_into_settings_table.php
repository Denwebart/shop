<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLogoDescriptionsIntoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('settings')->where('key', '=', 'logo.transparent')
		    ->update([
			    'title' => 'Логотип внизу сайта',
			    'description' => 'Отображается внизу сайта.'
		    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('settings')->where('key', '=', 'logo.transparent')
		    ->update([
			    'title' => 'Логотип для мобильных',
			    'description' => 'Логотип, который отображается на устроствах, где разрешение экрана меньше чет 767px.',
		    ]);
    }
}
