<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kriteria>
 */
class KriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'token_kriteria' => Str::random(16),
            'nama_kriteria' => $this->faker->randomElement([
                'Kecepatan Pelayanan',
                'Kualitas Pelayanan',
                'Profesionalisme Petugas',
                'Fasilitas Pelayanan',
                'Kemudahan Prosedur' 
            ]),
            'bobot' => $this->faker->randomFloat(2, 0.1, 0.3),
            'jenis' => $this->faker->randomElement(['benefit', 'const']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
