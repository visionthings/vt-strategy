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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_id')
                  ->constrained('dates')
                  ->cascadeOnDelete();

            $table->time('from_time');
            $table->time('to_time')->nullable();
            $table->enum('status',['available','booked_up'])->default('available');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
