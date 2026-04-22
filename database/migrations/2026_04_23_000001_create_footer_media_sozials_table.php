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
        Schema::create('footer_media_sozials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('footer_id')->constrained('footers')->onDelete('cascade');
            $table->foreignId('technology_id')->constrained('teknologis')->onDelete('cascade');
            $table->string('url');
            $table->integer('urutan')->default(0);
            $table->timestamps();

            $table->unique(['footer_id', 'technology_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_media_sozials');
    }
};
