<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_by');
            $table->string('invoice_no');
            $table->string('company_name');
            $table->string('email');
            $table->string('comment')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('invoice_status');
            $table->string('payment_type');
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
        Schema::dropIfExists('enroll_invoice');
    }
}
