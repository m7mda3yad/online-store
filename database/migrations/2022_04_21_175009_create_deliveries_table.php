<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateDeliveriesTable extends Migration
{

	public function up()
	{
		Schema::create('deliveries', function(Blueprint $table) {
            $table->increments('id');
			$table->string('email')->nullable();
			$table->string('password')->nullable();
			$table->string('name')->nullable();
			$table->string('phone')->nullable();
			$table->string('photo')->nullable();
			$table->string('address')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('deliveries');
	}
}
