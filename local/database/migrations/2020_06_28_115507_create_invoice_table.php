<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('invoice_by');
            $table->string('invoice_no');
            $table->string('customer_name');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('comment')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('invoice_status');
            $table->string('payment_type');
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('invoice');
    }
}
