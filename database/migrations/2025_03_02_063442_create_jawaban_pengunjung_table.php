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
        Schema::create('jawaban_pengunjung', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pertanyaan')->references('id_pertanyaan')->on('pertanyaans')->onDelete('cascade');
            $table->foreignId('id_pilihan')->references('id_pilihan')->on('pilihans')->onDelete('cascade');
            $table->foreignId('id_alternatif')->references('id_alternatif')->on('alternatifs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_pengunjung');
    }
};
