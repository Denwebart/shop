<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillPropertiesTableChangeTypeForBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('properties')->whereTitle('Бренд')
		    ->update(['type' => \App\Models\Property::TYPE_BRAND]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('properties')->whereTitle('Бренд')
		    ->update(['type' => \App\Models\Property::TYPE_DEFAULT]);
    }
}
