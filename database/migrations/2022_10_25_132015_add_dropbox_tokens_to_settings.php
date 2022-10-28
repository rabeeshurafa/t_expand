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
        Schema::table('settings', function (Blueprint $table) {
            $table->longText('dropbox_refresh_token')->default('E7u1dL2VlDMAAAAAAAAAAQu3ZsL2bZx4572ST5-OAzO8tOjXO_wf2uHM8yg7kOjo');
            $table->longText('dropbox_access_token')->default('sl.BR350bo0UOGa8bhMHVgLDVOsA--wpxVQkDrGeOY9nObotBMyC4rTcFxXUvN03JUtTQbaQQEaX0ymFJ0da0TxJjWjFw7JfKajbW-neEoUFtsP5uIkhL8ulKNlZbFJjB_Sj1IeAUzFTHyR');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('dropbox_refresh_token');
            $table->dropColumn('dropbox_access_token');
        });
    }
};
