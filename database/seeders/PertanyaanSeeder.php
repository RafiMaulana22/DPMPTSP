<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pertanyaans')->insert([
            [
                'token_pertanyaan' => Str::random(16),
                'pertanyaan' => 'Apakah Anda puas dengan pelayanan kami?'
            ],
            [
                'token_pertanyaan' => Str::random(16),
                'pertanyaan' => 'Apakah Anda puas dengan fasilitas kami?'
            ],
            [
                'token_pertanyaan' => Str::random(16),
                'pertanyaan' => 'Apakah Anda puas dengan kecepatan pelayanan kami?'
            ],
            [
                'token_pertanyaan' => Str::random(16),
                'pertanyaan' => 'Apakah Anda puas dengan kualitas pelayanan kami?'
            ],
            [
                'token_pertanyaan' => Str::random(16),
                'pertanyaan' => 'Apakah Anda puas dengan profesionalisme petugas kami?'
            ]
        ]);
    }
}
