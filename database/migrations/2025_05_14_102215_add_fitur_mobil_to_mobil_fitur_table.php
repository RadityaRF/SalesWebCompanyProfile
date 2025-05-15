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
        Schema::table('mobil_fitur', function (Blueprint $table) {
            $table->string('fitur_mobil')->nullable()->after('id_mobil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mobil_fitur', function (Blueprint $table) {
            $table->dropColumn('fitur_mobil');
        });
    }
};
