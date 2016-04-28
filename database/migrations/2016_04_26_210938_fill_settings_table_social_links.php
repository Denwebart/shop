<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FillSettingsTableSocialLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('settings')->insert([
		    [
			    'key' => 'socialButtons.vk',
			    'category' => \App\Models\Setting::CATEGORY_SITE,
			    'type' => \App\Models\Setting::TYPE_TEXT,
			    'title' => 'ВКонтакте',
			    'description' => 'Ссылка на страницу/группу/сообщество.',
			    'value' => '',
			    'is_active' => 1,
		    ],
		    [
			    'key' => 'socialButtons.facebook',
			    'category' => \App\Models\Setting::CATEGORY_SITE,
			    'type' => \App\Models\Setting::TYPE_TEXT,
			    'title' => 'Facebook',
			    'description' => 'Ссылка на страницу/группу/сообщество.',
			    'value' => '',
			    'is_active' => 1,
		    ],
		    [
			    'key' => 'socialButtons.instagram',
			    'category' => \App\Models\Setting::CATEGORY_SITE,
			    'type' => \App\Models\Setting::TYPE_TEXT,
			    'title' => 'Instagram',
			    'description' => 'Ссылка на страницу/группу/сообщество.',
			    'value' => '',
			    'is_active' => 1,
		    ],
		    [
			    'key' => 'socialButtons.twitter',
			    'category' => \App\Models\Setting::CATEGORY_SITE,
			    'type' => \App\Models\Setting::TYPE_TEXT,
			    'title' => 'Twitter',
			    'description' => 'Ссылка на страницу/группу/сообщество.',
			    'value' => '',
			    'is_active' => 1,
		    ],
		    [
			    'key' => 'socialButtons.google',
			    'category' => \App\Models\Setting::CATEGORY_SITE,
			    'type' => \App\Models\Setting::TYPE_TEXT,
			    'title' => 'Google+',
			    'description' => 'Ссылка на страницу/группу/сообщество.',
			    'value' => '',
			    'is_active' => 1,
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
	    DB::table('settings')->whereIn('key', [
		    'socialButtons.vk',
		    'socialButtons.facebook',
		    'socialButtons.instagram',
		    'socialButtons.twitter',
		    'socialButtons.google',
	    ])->delete();
    }
}
