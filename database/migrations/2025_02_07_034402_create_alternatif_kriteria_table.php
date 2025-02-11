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
            $table->foreignId('alternatif_id')->constrained('id_alternatif')->on('alternatifs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('kriteria_id')->constrained('id_kriteria')->on('kriterias')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('nilai', 10, 2);
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
