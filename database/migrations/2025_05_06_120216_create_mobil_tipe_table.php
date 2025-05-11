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
        Schema::create('mobil_tipe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mobil');
            $table->string('nama_tipe');
            $table->longText('spesifikasi');
            $table->integer('harga_mobil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobil_tipe');
    }
};
