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
        Schema::create('alternatif_kriteria', function (Blueprint $table) {
            $table->id('id_pivot');
            $table->foreignId('id_pilihan')->references('id_pilihan')->on('pilihans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_pertanyaan')->references('id_pertanyaan')->on('pertanyaans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif_kriteria');
    }
};
