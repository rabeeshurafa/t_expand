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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->integer('day_work_id');
            $table->string('work');
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->integer('state')->nullable();
            $table->integer('beneficial_id')->nullable();
            $table->string('beneficial_name')->nullable();
            $table->string('beneficial_model')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('enabled')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
};
