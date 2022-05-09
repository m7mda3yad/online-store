<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUbscribesTable extends Migration
{

    public function up()
	{
		Schema::create('subscribes', function(Blueprint $table) {
            $table->increments('id');
			$table->string('email')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('subscribes');
	}
}
