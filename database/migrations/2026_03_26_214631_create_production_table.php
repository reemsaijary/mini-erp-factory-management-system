<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production', function (Blueprint $table) {
            $table->id('production_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('machine_id');
            $table->unsignedBigInteger('employee_id');

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->enum('production_status', ['waiting', 'in_production', 'completed'])->default('waiting');
            $table->timestamps();

              $table->foreign('order_id')
                  ->references('order_id')
                  ->on('orders')
                  ->onDelete('cascade');

            $table->foreign('machine_id')
                  ->references('machine_id')
                  ->on('machines')
                  ->onDelete('cascade');

            $table->foreign('employee_id')
                  ->references('employee_id')
                  ->on('employees')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production');
    }
};
