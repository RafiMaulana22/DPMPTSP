<?php

namespace Database\Factories;

use App\Models\pertanyaan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pilihan>
 */
class PilihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pertanyaanDanNilai = [
            'Sangat Tidak Puas' => 1,
            'Tidak Puas' => 2,
            'Cukup Puas' => 3,
            'Puas' => 4,
            'Sangat Puas' => 5
        ];

        $pilihan = $this->faker->randomElement(array_keys($pertanyaanDanNilai));
        $nilai = $pertanyaanDanNilai[$pilihan];

        return [
            'token_pilihan' => Str::random(16),
            'pilihan' => $pilihan,
            'nilai' => $nilai,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
