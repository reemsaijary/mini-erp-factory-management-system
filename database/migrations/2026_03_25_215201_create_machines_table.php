<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id('machine_id');
            $table ->string('machine_type');
            $table ->string('machine_name');
            $table ->date('purchase_date')->nullable();
            $table ->enum('machine_status',['working','under_maintenance','inactive'])->default('working');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
