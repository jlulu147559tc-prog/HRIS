<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop the table if it exists to prevent duplicate key/column errors
        Schema::dropIfExists('payslips');

        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('period'); // Use 'period' directly
            $table->decimal('gross_pay', 12, 2);
            $table->decimal('sss_deduction', 10, 2);
            $table->decimal('philhealth_deduction', 10, 2);
            $table->decimal('pagibig_deduction', 10, 2);
            $table->decimal('tax_deduction', 10, 2);
            $table->decimal('net_pay', 12, 2);
            $table->string('status')->default('Finalized');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payslips');
    }
};