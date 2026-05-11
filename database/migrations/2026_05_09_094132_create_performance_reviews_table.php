<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->string('review_month'); // e.g., "May 2026"
            $table->date('review_date');
            $table->integer('work_quality');
            $table->integer('timeliness');
            $table->integer('teamwork');
            $table->integer('communication');
            $table->integer('initiative');
            $table->decimal('composite_score', 5, 2);
            $table->text('comments')->nullable();
            $table->string('status')->default('Completed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('performance_reviews');
    }
};
