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
        Schema::table('proyeks', function (Blueprint $table) {
            // Add thumbnail image path
            $table->string('path_gambar_thumb')->nullable()->after('path_gambar');

            // Add indexes with explicit names for safer rollback
            $table->index('status', 'idx_proyeks_status');
            $table->index('urutan', 'idx_proyeks_urutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proyeks', function (Blueprint $table) {
            $table->dropColumn('path_gambar_thumb');

            // Drop indexes using explicit names
            $table->dropIndex('idx_proyeks_status');
            $table->dropIndex('idx_proyeks_urutan');
        });
    }
};
