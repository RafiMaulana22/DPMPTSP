<?php

namespace Database\Factories;

use App\Models\Alternatif;
use App\Models\Kriteria;
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
            'alternatif_id' => Alternatif::inRandomOrder()->first()->id_alternatif ?? Alternatif::factory(),
            'kriteria_id' => Kriteria::inRandomOrder()->first()->id_kriteria ?? Kriteria::factory(),
            'nilai' => $this->faker->randomFloat(2, 1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
