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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('admin_id')
                  ->nullable()
                  ->constrained('admins')
                  ->cascadeOnDelete();
            $table->float('price')->default(0);
            $table->float('tax_price')->nullable();
            $table->float('tax')->nullable();
            
            $table->enum('status',['active','archived'])->default('active');
            $table->bigInteger('order_count')->default(0);
            // $table->enum('status',['pending','done'])->default('pending');
            $table->enum('payment_status',['pending','paid']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
