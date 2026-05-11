<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('vacation_balance')->default(15);
            $table->integer('sick_balance')->default(10);
            $table->integer('emergency_balance')->default(3);
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['vacation_balance', 'sick_balance', 'emergency_balance']);
        });
    }
};
