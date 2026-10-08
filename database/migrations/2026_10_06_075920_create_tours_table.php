<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');        // e.g., PARIS TOUR
            $table->string('sub_title')->nullable(); // e.g., I FAL TOWER
            $table->string('duration');     // e.g., 1 week
            $table->decimal('price', 10, 2); // e.g., 2000.00
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->json('highlights')->nullable(); // JSON Array for tour highlights
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};