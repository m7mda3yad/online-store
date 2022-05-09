<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('customers')->onDelete('cascade');
            $table->tinyInteger('delivery_type')->nullable()->default(0);
            $table->tinyInteger('paid_type')->nullable()->default(0);
            $table->timestamp('date')->nullable();
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
