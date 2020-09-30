<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("invoice_id")->unsigned();
            $table->foreign('invoice_id')->references('id')->on('invoice');
            $table->string('invoice_status')->nullable();
            $table->integer('notify');
            $table->longText('comment');
            $table->string('document')->nullable();
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
        Schema::dropIfExists('invoice_history');
    }
}
