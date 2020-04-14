<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consecutive');
            $table->dateTime('expedition_date');
            $table->dateTime('due_date');
            $table->dateTime('received_date')->nullable();
            $table->string('type');
            $table->string('tax');
            $table->string('description');
            $table->integer('total');
            $table->string('state')->default("PENDING");
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();

            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('seller_id')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('seller_id')->references('id')->on('sellers');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
