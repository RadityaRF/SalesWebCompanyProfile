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
        Schema::table('mobil', function (Blueprint $table) {
            $table->string('gambar_mobil')->nullable()->after('jenis_mobil');
            $table->string('highlight')->nullable()->after('gambar_mobil');
            $table->longText('deskripsi')->nullable()->after('highlight');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobil', function (Blueprint $table) {
            $table->dropColumn('gambar_mobil');
            $table->dropColumn('highlight');
            $table->dropColumn('deskripsi');
        });
    }
};
