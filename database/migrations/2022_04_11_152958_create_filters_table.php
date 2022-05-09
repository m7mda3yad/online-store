<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateFiltersTable extends Migration
{
	public function up()
	{
		Schema::create('filters', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
            $table->boolean('active')->nullable()->default(true);
            $table->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('filters');
	}
}
