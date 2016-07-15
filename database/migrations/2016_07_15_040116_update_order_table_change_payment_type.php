<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrderTableChangePaymentType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    DB::table('orders')
		    ->where('payment_type', '!=', 0)
		    ->where('payment_type', '!=', 1)
		    ->update(['payment_type' => \App\Models\Order::PAYMENT_TYPE_CASH]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	
    }
}
