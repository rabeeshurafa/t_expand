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
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('year1')->nullable();
            $table->string('month1')->nullable();
            $table->string('year2')->nullable();
            $table->string('month2')->nullable();
            $table->string('fromNo')->nullable();
            $table->string('toNo')->nullable();
            $table->string('total')->nullable();
            $table->string('encoding')->nullable();
            $table->text('notes')->nullable();
            $table->string('place')->nullable();
            $table->string('url')->default('folder');
            $table->string('model')->default('App\\Models\\Folder');
            $table->text('allowed_emp')->nullable();
            $table->integer('added_by');
            $table->integer('deleted_by')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('folders');
    }
};
