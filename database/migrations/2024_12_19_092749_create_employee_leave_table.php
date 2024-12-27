<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('emp_id');
            $table->string('emp_email');
            $table->date('date');
            $table->string('reason');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('employee_leaves');
    }
};
