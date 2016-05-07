<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateIdValueForContactAndSitemapPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('pages')->where('id', '=', 2)->update(['id' => 999]);
	    DB::table('pages')->where('id', '=', 3)->update(['id' => 2]);
	    DB::table('pages')->where('id', '=', 4)->update(['id' => 3]);
	    DB::table('pages')->where('id', '=', 999)->update(['id' => 4]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('pages')->where('id', '=', 4)->update(['id' => 999]);
	    DB::table('pages')->where('id', '=', 3)->update(['id' => 4]);
	    DB::table('pages')->where('id', '=', 2)->update(['id' => 3]);
	    DB::table('pages')->where('id', '=', 999)->update(['id' => 2]);
    }
}
