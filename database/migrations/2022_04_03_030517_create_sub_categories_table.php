<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateSubCategoriesTable extends Migration
{
	public function up()
	{
		Schema::create('sub_categories', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
			$table->boolean('active')->nullable()->default(1);
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
		Schema::drop('sub_categories');
	}
}
