<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FilterSubCategories extends Migration
{
       public function up()
    {

        Schema::create('filter_sub_categories', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();

            $table->integer('filter_id')->unsigned()->nullable();
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');

            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');

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
        //
    }
}
