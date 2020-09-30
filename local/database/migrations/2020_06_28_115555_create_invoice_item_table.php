<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("invoice_id")->unsigned();
            $table->foreign('invoice_id')->references('id')->on('invoice');
            $table->integer("ticket_type_id")->nullable()->unsigned();
            $table->foreign('ticket_type_id')->references('id')->on('ticket_type');
            $table->integer("quantity")->default(1);
            $table->integer('product_id');
            $table->string('product_type')->nullable();
            $table->string('name');
            $table->string('type');
            $table->integer('duration')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('number_of');
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
        Schema::dropIfExists('invoice_item');
    }
}
