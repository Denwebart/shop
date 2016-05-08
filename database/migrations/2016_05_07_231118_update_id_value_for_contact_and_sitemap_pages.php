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

	    DB::table('pages')->where('parent_id', '=', 2)->update(['parent_id' => 4]);
	    DB::table('products')->where('category_id', '=', 2)->update(['category_id' => 4]);
	    DB::table('menus')->where('page_id', '=', 2)->update(['page_id' => 999]);
	    DB::table('menus')->where('page_id', '=', 4)->update(['page_id' => 2]);
	    DB::table('menus')->where('page_id', '=', 999)->update(['page_id' => 4]);
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

	    DB::table('pages')->where('parent_id', '=', 4)->update(['parent_id' => 2]);
	    DB::table('products')->where('category_id', '=', 4)->update(['category_id' => 2]);
	    DB::table('menus')->where('page_id', '=', 4)->update(['page_id' => 999]);
	    DB::table('menus')->where('page_id', '=', 2)->update(['page_id' => 4]);
	    DB::table('menus')->where('page_id', '=', 999)->update(['page_id' => 2]);
    }
}
