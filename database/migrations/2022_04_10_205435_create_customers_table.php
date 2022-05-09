<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCustomersTable extends Migration
{

	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->string('password')->nullable();
			$table->string('phone')->nullable();
			$table->string('photo')->nullable();
			$table->string('address')->nullable();
			$table->integer('city_id')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->softDeletes();
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
		Schema::drop('customers');
	}
}
