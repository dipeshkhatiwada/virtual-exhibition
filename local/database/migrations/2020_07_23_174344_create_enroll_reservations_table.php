<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enroll_reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->integer('employer_id');
            $table->string('company_name');
            $table->string('seo_url');
            $table->string('company_website');
            $table->string('intro_video');
            $table->string('fair_detail');
            // $table->string('banner_file');
            $table->text('description');
            $table->float('total_price')->default(0);
            $table->boolean('publish_status')->default(0);
            $table->boolean('payment_status');
            $table->boolean('video_facility')->default(0);
            $table->boolean('chat_facility')->default(0);
            $table->boolean('livestream_facility')->default(0);


            $table->integer('views')->default(1);


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
        Schema::dropIfExists('enroll_reservations');
    }
}
