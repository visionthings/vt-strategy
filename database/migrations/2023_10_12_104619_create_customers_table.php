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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('rate',[1,2,3,4,5]);
            $table->string('job_name');
            $table->text('comment');
            $table->enum('status',['active','no_active'])
                  ->default('no_active');
            $table->foreignId('consultation_id')
                  ->constrained('consultations')
                  ->cascadeOnDelete();      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
