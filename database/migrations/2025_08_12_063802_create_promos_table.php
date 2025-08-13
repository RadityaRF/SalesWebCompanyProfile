<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Optional text for promo
            $table->string('image_path'); // Banner / Brosur
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('promos');
    }
};
