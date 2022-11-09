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
        Schema::table('ticket_configs', function (Blueprint $table) {
            $table->integer('can_reply')->default(1);
            $table->longText('flow')->default('[{"nextDeptId":0,"nextEmpId":0}]');
            $table->longText('debt_settings')->default('[
            {"debtIndex":"1","isDebtMandatory":"2","moneyResponsibleEmp":[],"payedResponsibleEmp":[]},
            {"debtIndex":"2","isDebtMandatory":"2","moneyResponsibleEmp":[],"payedResponsibleEmp":[]},
            {"debtIndex":"3","isDebtMandatory":"2","moneyResponsibleEmp":[],"payedResponsibleEmp":[]},
            {"debtIndex":"4","isDebtMandatory":"2","moneyResponsibleEmp":[],"payedResponsibleEmp":[]},
            {"debtIndex":"5","isDebtMandatory":"2","moneyResponsibleEmp":[],"payedResponsibleEmp":[]},
            {"debtIndex":"6","isDebtMandatory":"2","moneyResponsibleEmp":[],"payedResponsibleEmp":[]}
            ]');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_configs', function (Blueprint $table) {
            $table->dropColumn('can_reply');
            $table->dropColumn('flow');
            $table->dropColumn('debt_settings');
        });
    }
};
