<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSubFiltersTable.
 */
class CreateSubFiltersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_filters', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
            $table->integer('filter_id')->unsigned()->nullable();
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');

            $table->boolean('active')->nullable()->default(true);

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
		Schema::drop('sub_filters');
	}
}
