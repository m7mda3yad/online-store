<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddKeyInProductSupFiltersTable extends Migration{
    public function up()
    {
        Schema::table('product_sup_filters', function (Blueprint $table) {
            $table->string('key')->nullable();            
        });
    }
    public function down()
    {
        Schema::table('product_sup_filters', function (Blueprint $table) {            
            $table->dropColumn('key');
        });
    }
}
