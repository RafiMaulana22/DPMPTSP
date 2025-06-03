<?php

namespace Database\Seeders;

use App\Models\pilihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pilihans')->insert([
            'token_pilihan' => Str::random(16),
            'pilihan' => 'Sangat Puas',
            'nilai' => 5,
        ],
        [
            'token_pilihan' => Str::random(16),
            'pilihan' => 'Puas',
            'nilai' => 4,
        ],
        [
            'token_pilihan' => Str::random(16),
            'pilihan' => 'Cukup Puas',
            'nilai' => 3,
        ],
        [
            'token_pilihan' => Str::random(16),
            'pilihan' => 'Kurang Puas',
            'nilai' => 2,
        ],
        [
            'token_pilihan' => Str::random(16),
            'pilihan' => 'Tidak Puas',
            'nilai' => 1,
        ],
        [
            'token_pilihan' => Str::random(16),
            'pilihan' => 'Tidak Tahu',
            'nilai' => 0,
        ]);
    }
}
