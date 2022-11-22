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
            $table->string('sizeAttachments')->default('0');
            $table->string('countAttachments')->default('0');
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
            $table->dropColumn('sizeAttachments');
            $table->dropColumn('countAttachments');
        });
    }
};
