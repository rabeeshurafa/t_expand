<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agenda_topics', function (Blueprint $table) {
            $table->string('converterFrom')->nullable();
            $table->integer('converterFromId')->nullable();
            $table->longText('recommendation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agenda_topics', function (Blueprint $table) {
            $table->dropColumn('converterFrom');
            $table->dropColumn('converterFromId');
            $table->dropColumn('recommendation');
        });
    }
};
