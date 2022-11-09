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
            $table->string('emp_receive')->nullable();
            $table->string('dept_receive')->nullable();
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
            $table->dropColumn('emp_receive');
            $table->dropColumn('dept_receive');
        });
    }
};
