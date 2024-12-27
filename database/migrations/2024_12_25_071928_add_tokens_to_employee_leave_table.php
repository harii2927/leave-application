<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('employee_leaves', function (Blueprint $table) {
            $table->string('approve_token')->nullable();
            $table->string('reject_token')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropColumn(['approve_token', 'reject_token']);
        });
    }
};
