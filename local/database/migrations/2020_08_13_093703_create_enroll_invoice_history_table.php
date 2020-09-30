<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollInvoiceHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_invoice_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("invoice_id")->unsigned();
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
        Schema::dropIfExists('enroll_invoice_history');
    }
}
