<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_invoice_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("invoice_id")->unsigned();        
            $table->string('category');
            $table->string('booth_name');
            $table->string('booth_type');
            $table->string('type');
            $table->decimal('amount', 10, 2);
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
        Schema::dropIfExists('enroll_invoice_item');
    }
}
