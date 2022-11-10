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
            $table->integer('agendaDetailId')->nullable();
            $table->integer('agendaTopicId')->nullable();
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
            $table->dropColumn('agendaDetailId');
            $table->dropColumn('agendaTopicId');
        });
    }
};
