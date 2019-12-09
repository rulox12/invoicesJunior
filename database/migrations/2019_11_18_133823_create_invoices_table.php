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
            $table->dateTime('expedition_date');
            $table->dateTime('due_date');
            $table->dateTime('received_date')->nullable();
            $table->string('type');
            $table->string('tax');
            $table->string('description');
            $table->integer('total');
            $table->string('state')->default('Pending');

            $table->timestamps();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('user_id');

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
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
