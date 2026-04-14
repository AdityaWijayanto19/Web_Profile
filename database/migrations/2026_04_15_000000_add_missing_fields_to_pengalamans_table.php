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
        Schema::table('pengalamans', function (Blueprint $table) {
            // Add missing columns after existing ones
            $table->string('perusahaan')->nullable()->after('jabatan');
            $table->string('tahun')->nullable()->after('perusahaan');
            $table->string('ikon')->default('flag')->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengalamans', function (Blueprint $table) {
            $table->dropColumn(['perusahaan', 'tahun', 'ikon']);
        });
    }
};
