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
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            // Link to the employee
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            
            $table->string('period'); // e.g., 'Q1 2026'
            $table->string('reviewer_name'); 
            $table->decimal('score', 4, 1); // e.g., 93.1
            $table->string('rating'); // e.g., 'Excellent', 'Good'
            $table->date('review_date');
            
            // We use json columns to store the lists of competencies and goals!
            $table->json('competencies')->nullable();
            $table->json('goals')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_reviews');
    }
};
