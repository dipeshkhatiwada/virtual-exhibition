<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollIndividualCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_individual_cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employer_id');
            $table->integer('reservation_id');  
            $table->integer('booth_id');        
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
        Schema::dropIfExists('enroll_individual_cart');
    }
}
