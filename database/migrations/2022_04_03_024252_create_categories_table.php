<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCategoriesTable extends Migration{

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
			$table->boolean('active')->nullable()->default(1);
            $table->softDeletes();
            $table->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('categories');
	}
}
