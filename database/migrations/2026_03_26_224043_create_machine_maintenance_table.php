<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machine_maintenance', function (Blueprint $table) {
            $table->id('maintenance_id');
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('reported_by');
            $table->text('description');
            $table->date('report_date');
            $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
            
            $table->timestamps();

             $table->foreign('machine_id')
                  ->references('machine_id')
                  ->on('machines')
                  ->onDelete('cascade');

            $table->foreign('reported_by')
                  ->references('employee_id')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machine_maintenance');
    }
};
