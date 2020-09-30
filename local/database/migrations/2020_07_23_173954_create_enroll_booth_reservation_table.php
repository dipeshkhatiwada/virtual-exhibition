<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollBoothReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_booth_reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('reservation_id');
            $table->integer('employer_id');
            $table->string('booth_name');
            $table->string('booth_type');
            $table->float('price');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('enroll_booth_reservation');
    }
}
