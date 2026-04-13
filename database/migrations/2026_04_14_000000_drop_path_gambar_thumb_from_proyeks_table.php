<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Drop path_gambar_thumb column as we're using only main image
     */
    public function up(): void
    {
        Schema::table('proyeks', function (Blueprint $table) {
            $table->dropColumn('path_gambar_thumb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyeks', function (Blueprint $table) {
            $table->string('path_gambar_thumb')->nullable()->after('path_gambar');
        });
    }
};
