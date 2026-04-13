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
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('meta_description', 160)->nullable();
            $table->longText('isi_konten');
            $table->string('path_gambar')->nullable();
            $table->integer('menit_baca')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamp('tanggal_rilis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
