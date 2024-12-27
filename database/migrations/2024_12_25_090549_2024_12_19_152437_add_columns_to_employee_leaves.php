<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprovalTokenToEmployeeLeaves extends Migration
{
    public function up()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->string('approval_token')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->dropColumn('approval_token');
        });
    }
};
