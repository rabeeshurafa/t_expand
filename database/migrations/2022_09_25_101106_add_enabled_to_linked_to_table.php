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
        Schema::table('linked_tos', function (Blueprint $table) {
            $table->integer('deleted_by')->default(0);
            $table->integer('enabled')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('linked_tos', function (Blueprint $table) {
            $table->dropColumn('deleted_by');
            $table->dropColumn('enabled');
        });
    }
};
