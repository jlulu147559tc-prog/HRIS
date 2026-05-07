<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique(); // e.g., EMP002
            $table->string('first_name');
            $table->string('last_name');
            $table->string('initials'); // e.g., MS
            $table->string('email')->unique();
            $table->string('department'); // e.g., Sales
            $table->string('position'); // e.g., Sales Manager
            $table->date('hire_date');
            $table->string('status')->default('Active'); // Active or Inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
