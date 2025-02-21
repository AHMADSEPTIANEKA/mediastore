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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('picture')->nullable();
            $table->string('name');
            $table->string('brand');
            $table->string('type');
            $table->string('price', 10, 2);  // Menggunakan decimal untuk harga
            $table->string('camera_main')->nullable();
            $table->string('camera_ultra')->nullable();
            $table->string('camera_front')->nullable();
            $table->float('screen_size', 3, 1)->nullable();  // Menggunakan decimal untuk ukuran layar
            $table->string('screen_resolution')->nullable();
            $table->integer('refresh_rate')->nullable();
            $table->string('processor')->nullable();
            $table->integer('battery_capacity')->nullable();  // Menggunakan integer untuk kapasitas baterai
            $table->integer('charging_speed')->nullable();  // Menggunakan integer untuk kecepatan pengisian daya
            $table->string('ip_rating')->nullable();  // Untuk rating ketahanan air & debu (IP rating)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
