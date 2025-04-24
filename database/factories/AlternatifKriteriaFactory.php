<?php

namespace Database\Factories;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\pertanyaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AlternatifKriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_alternatif' => Alternatif::inRandomOrder()->first()->id_alternatif ?? Alternatif::factory(),
            'id_pertanyaan' => pertanyaan::inRandomOrder()->first()->id_pertanyaan ?? pertanyaan::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
