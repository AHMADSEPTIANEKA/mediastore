<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('brand');
            $table->string('price', 10, 2);
            $table->string('processor')->nullable();
            $table->integer('ram')->nullable(); // RAM dalam GB
            $table->integer('storage')->nullable(); // Storage dalam GB
            $table->float('screen_size', 3, 1)->nullable(); // Ukuran layar
            $table->string('battery_life')->nullable(); // Daya tahan baterai
            $table->string('picture')->nullable(); // Gambar laptop
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
}; 