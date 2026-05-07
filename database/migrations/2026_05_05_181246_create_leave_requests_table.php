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
    Schema::create('leave_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained()->onDelete('cascade');
        $table->string('leave_type'); // Vacation, Sick, Emergency
        $table->date('start_date');
        $table->date('end_date');
        $table->integer('days_requested');
        $table->text('reason');
        $table->string('status')->default('Pending'); // Pending, Approved, Rejected
        $table->string('approved_by')->nullable();
        $table->date('applied_date');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
