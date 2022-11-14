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
        Schema::table('elecs', function (Blueprint $table) {
            $table->integer('beneficiaryId')->nullable();
            $table->string('beneficiary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('elecs', function (Blueprint $table) {
            $table->dropColumn('beneficiaryId');
            $table->dropColumn('beneficiary');
        });
    }
};