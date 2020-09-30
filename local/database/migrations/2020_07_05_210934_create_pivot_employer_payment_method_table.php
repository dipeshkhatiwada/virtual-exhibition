<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotEmployerPaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('pivot_employer_payment_method', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->integer('employers_id')->unsigned();
            $table->foreign('employers_id')->references('employers_id')->on('employer_user');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_employer_payment_method');
    }
}
