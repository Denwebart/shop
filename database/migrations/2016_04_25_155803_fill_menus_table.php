<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('menus')->insert(
		    [
			    [
				    'id' => 1,
				    'type' => \App\Models\Menu::TYPE_MAIN,
				    'page_id' => \App\Models\Page::whereAlias('/')->first()->id,
				    'position' => '1',
			    ],
			    [
				    'id' => 2,
				    'type' => \App\Models\Menu::TYPE_MAIN,
				    'page_id' => \App\Models\Page::whereAlias('kontakty')->first()->id,
				    'position' => '2',
			    ],
			    [
				    'id' => 3,
				    'type' => \App\Models\Menu::TYPE_MAIN,
				    'page_id' => \App\Models\Page::whereAlias('karta-sajta')->first()->id,
				    'position' => '3',
			    ],
			    [
				    'id' => 4,
				    'type' => \App\Models\Menu::TYPE_PRODUCT,
				    'page_id' => \App\Models\Page::whereAlias('katalog')->first()->id,
				    'position' => '1',
			    ],
		    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('menus')
		    ->whereIn('id', [1, 2, 3, 4])
		    ->delete();
    }
}
