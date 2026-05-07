<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            // Ensure the record_date field exists as a string or date column that allows null values during the check
            $table->string('record_date')->nullable()->change();
            $table->string('day_of_week')->nullable()->change();
            $table->string('hours_worked')->nullable()->change();
        });
    }

    public function down()
    {
        // No down needed
    }
};