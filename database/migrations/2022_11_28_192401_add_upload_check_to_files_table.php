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
        Schema::table('files', function (Blueprint $table) {
            $table->tinyInteger('upload_s3')->default(0);
            $table->tinyInteger('upload_dropbox')->default(0);
            $table->tinyInteger('upload_ftp')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('upload_s3');
            $table->dropColumn('upload_dropbox');
            $table->dropColumn('upload_ftp');
        });
    }
};
