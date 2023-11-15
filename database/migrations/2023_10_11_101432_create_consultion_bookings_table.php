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
        Schema::create('consultion_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();     
            $table->foreignId('consultion_id')
                    ->nullable()
                    ->constrained('consultations')
                    ->nullOnDelete();
                    
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->enum('payment_status',['pending','paid'])->default('pending');
            $table->time('from_time');  
            $table->time('to_time')->nullable();  
            $table->text('meeting_link')->nullable();
            $table->enum('status',['pending','success','failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultion_bookings');
    }
};
