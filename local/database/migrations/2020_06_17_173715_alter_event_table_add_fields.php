<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterEventTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->integer('ticket_type')->after('event_category_id');
            $table->integer('price')->nullable()->unsigned()->default(0)->after('ticket_type');
            $table->string('external_url')->nullable()->after('price');
            $table->integer('event_type')->after('external_url');
            $table->boolean('participants_limit')->default(0)->after('event_type');
            $table->integer('participants_max_limit')->unsigned()->nullable()->after('participants_limit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event', function (Blueprint $table) {
            $table->dropColumn(['ticket_type', 'price', 'external_url', 'event_type', 'participants_limit', 'participants_max_limit']);
        });
    }
}
