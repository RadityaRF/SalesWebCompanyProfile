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
        Schema::table('mobil_tipe', function (Blueprint $table) {
            $table->string('gambar_mobil_tipe')->nullable()->after('spesifikasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobil_tipe', function (Blueprint $table) {
            $table->dropColumn('gambar_mobil_tipe');
        });
    }
};
