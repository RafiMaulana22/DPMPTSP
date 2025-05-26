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
        Schema::table('alternatifs', function (Blueprint $table) {
            $table->string('profesi')->after('nama_alternatif')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alternatifs', function (Blueprint $table) {
            $table->dropColumn('profesi');
        });
    }
};
