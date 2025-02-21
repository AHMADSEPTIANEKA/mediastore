<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('accessories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('brand');
        $table->string('price', 10, 2);
        $table->text('description')->nullable();
        $table->string('picture')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('accessories');
    }
};
