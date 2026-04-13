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
        Schema::create('proyek_teknologis', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel proyeks
            $table->foreignId('id_proyek')->constrained('proyeks')->onDelete('cascade');
            // Foreign Key ke tabel teknologis
            $table->foreignId('id_teknologi')->constrained('teknologis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_teknologis');
    }
};
