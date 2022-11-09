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
        Schema::create('daily_works', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id');
            $table->string('name');
            $table->date('date');
            $table->time('start')->nullable();
            $table->time('end')->nullable();
            $table->string('day');
            $table->integer('added_by');
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
        Schema::dropIfExists('daily_works');
    }
};
