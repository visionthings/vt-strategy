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
        Schema::create('governances', function (Blueprint $table) {
            $table->id();
            $table->string('section_description');
            $table->string('description_one');
            $table->string('description_two');
            $table->string('description_three');
            $table->enum('status',['active','archived'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governances');
    }
};
