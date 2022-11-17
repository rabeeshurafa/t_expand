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
        Schema::table('trade_archives', function (Blueprint $table) {
            $table->text('connect_to')->default('{"connectToArchive":[],"connectToTrade":[]}');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trade_archives', function (Blueprint $table) {
            $table->dropColumn('connect_to');
        });
    }
};
