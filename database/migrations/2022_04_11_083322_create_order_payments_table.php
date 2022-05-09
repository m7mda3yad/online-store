<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('InvoiceId')->nullable();       // patment id
            $table->string('InvoiceURL')->nullable();       //patment  url
            $table->string('InvoiceStatus')->nullable();    //patment Paid or Not
            $table->boolean('IsSuccess')->nullable()->default(false);       // true
            $table->integer('InvoiceValue')->nullable();    // price from payment
            $table->integer('price')->nullable();           //order price

            $table->integer('order_id')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->integer('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('TransactionDate')->nullable();// date
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
        Schema::dropIfExists('order_payments');
    }
}
