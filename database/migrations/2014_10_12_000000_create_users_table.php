<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('login', 50);
	        $table->string('email')->unique();
	        $table->string('password');
	        $table->tinyInteger('role')->default(0);
	        $table->string('firstname', 100);
	        $table->string('lastname', 100);
	        $table->string('avatar');
	        $table->boolean('is_active')->default(0);
	        $table->string('activation_code')->nullable();
	        $table->rememberToken();
	        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
