<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('pages')->insert(
		    [
			    [
				    'alias' => '/',
				    'user_id' => '1',
				    'type' => '2',
				    'title' => 'Главная страница',
				    'menu_title' => 'Главная',
				    'created_at' => \Carbon\Carbon::now(),
				    'published_at' => \Carbon\Carbon::now(),
			    ],
			    [
				    'alias' => 'katalog',
				    'user_id' => '1',
				    'type' => '3',
				    'is_container' => 1,
				    'title' => 'Каталог товаров',
				    'menu_title' => 'Каталог',
				    'created_at' => \Carbon\Carbon::now(),
				    'published_at' => \Carbon\Carbon::now(),
			    ],
			    [
				    'alias' => 'kontakty',
				    'user_id' => '1',
				    'type' => '2',
				    'title' => 'Контакты',
				    'menu_title' => 'Контакты',
				    'created_at' => \Carbon\Carbon::now(),
				    'published_at' => \Carbon\Carbon::now(),
			    ],
			    [
				    'alias' => 'karta-sajta',
				    'user_id' => '1',
				    'type' => '2',
				    'title' => 'Карта сайта',
				    'menu_title' => 'Карта сайта',
				    'created_at' => \Carbon\Carbon::now(),
				    'published_at' => \Carbon\Carbon::now(),
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
	    DB::table('pages')
		    ->whereIn('alias', ['/', 'katalog', 'kontakty', 'karta-sajta'])
		    ->delete();
    }
}
