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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // This links the attendance to a specific employee in the employees table
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); 
            
            $table->date('record_date');
            $table->string('day_of_week');
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->string('hours_worked')->nullable();
            $table->string('status'); // Present, Late, Overtime
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
