<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDescriptionOfFooterTextIntoSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('settings')->where('key', '=', 'footerText')->update([
	    	'title' => 'Текст внизу сайта',
	    	'description' => 'Текст под логотипом в нижней части сайта.',
	    ]);
	    DB::table('settings')->where('key', '=', 'logo.mobile')->update([
		    'description' => 'Логотип, который отображается на устройствах, где разрешение экрана меньше чем 767px.',
	    ]);
	    DB::table('settings')->where('key', '=', 'meta.author')->update([
		    'description' => "Служит для идентификации автора или принадлежности документа.
			                    \n
			                    Может содержать имя автора сайта.
								\n
								Как правило, не используется вместе с мета-тегом Copyright.",
	    ]);
	    DB::table('settings')->where('key', '=', 'meta.copyright')->update([
		    'description' => "Служит для идентификации автора или принадлежности документа. 
								\n
								Может содержать название организации или авторские права. 
								Если сайт принадлежит какой-либо организации, 
								целесообразнее использовать тег Copyright. 
								\n
								Как правило, не используется вместе с мета-тегом Author.",
	    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    DB::table('settings')->where('key', '=', 'footerText')->update([
		    'title' => 'Текст в футере',
		    'description' => 'Текст в футере.',
	    ]);
    }
}
