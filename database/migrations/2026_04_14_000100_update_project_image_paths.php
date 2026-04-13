<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Update image paths to remove /main/ prefix
     * Changes: uploads/projects/main/xxx.webp → uploads/projects/xxx.webp
     */
    public function up(): void
    {
        // Update all proyeks paths
        DB::table('proyeks')
            ->where('path_gambar', 'like', 'uploads/projects/main/%')
            ->update([
                'path_gambar' => DB::raw("REPLACE(path_gambar, '/main/', '/')")
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore paths with /main/ prefix
        DB::table('proyeks')
            ->where('path_gambar', 'like', 'uploads/projects/%')
            ->where('path_gambar', 'not like', 'uploads/projects/main/%')
            ->update([
                'path_gambar' => DB::raw("REPLACE(path_gambar, 'uploads/projects/', 'uploads/projects/main/')")
            ]);
    }
};
