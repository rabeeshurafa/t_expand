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
        Schema::table('app_ticket1s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket2s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket3s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket4s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket5s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket6s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket7s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket8s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket9s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket10s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket11s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket12s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket13s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket14s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket15s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket16s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket17s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket18s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket19s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket20s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket21s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket22s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket23s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket24s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket25s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket26s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket27s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket28s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket29s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket30s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket31s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket32s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket33s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket34s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket35s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket36s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket37s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket38s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket39s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket40s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket41s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket42s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket43s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket44s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
        Schema::table('app_ticket45s', function (Blueprint $table) {
            $table->integer('flow_index')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_ticket1s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket2s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket3s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket4s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket5s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket6s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket7s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket8s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket9s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket11s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket12s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket13s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket14s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket15s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket16s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket17s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket18s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket19s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket20s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket21s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket22s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket23s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket24s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket25s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket26s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket27s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket28s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket29s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket30s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket31s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket32s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket33s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket34s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket35s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket36s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket37s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket38s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket39s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket40s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket41s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket42s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket43s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket44s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
        Schema::table('app_ticket45s', function (Blueprint $table) {
            $table->dropColumn('flow_index');
        });
    }
};
