<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->date('contractDate')->nullable();
            $table->string('contractValue')->nullable();
            $table->string('contractCurrencyID')->nullable();
            $table->date('orderDate')->nullable();
            $table->date('receiveDate')->nullable();
            $table->date('finishDate')->nullable();
            $table->date('dateStart')->nullable()->change();
            $table->date('dateEnd')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('contractDate');
            $table->dropColumn('contractValue');
            $table->dropColumn('contractCurrencyID');
            $table->dropColumn('orderDate');
            $table->dropColumn('receiveDate');
            $table->dropColumn('finishDate');
        });
    }
};
