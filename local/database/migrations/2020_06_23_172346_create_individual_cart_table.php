<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individual_cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger("employees_id");
            $table->foreign('employees_id')->references('id')->on('employees');
            $table->unsignedInteger("jobs_id");
            $table->foreign('jobs_id')->references('id')->on('event');
            $table->unsignedInteger("ticket_type_id")->nullable();
            $table->foreign('ticket_type_id')->references('id')->on('ticket_type');
            $table->integer("job_type_id")->nullable();
            $table->integer("quantity")->unsigned()->default(1);
            $table->integer("rate")->unsigned();
            $table->string("type")->nullable();
            $table->integer("total_amount")->unsigned();
            $table->time("duration")->nullable();
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
        Schema::dropIfExists('individual_cart');
    }
}
