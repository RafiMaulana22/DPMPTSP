<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\AlternatifKriteria;
use App\Models\Kriteria;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolePermissionSeeder::class,
        ]);

        User::create(
            [
                'name' => 'rafi',
                'email' => 'rafi@gmail.com',
                'password' => bcrypt('123'),
            ]
        )->assignRole('admin');
        User::create(
            [
                'name' => 'lilis',
                'email' => 'lilis@gmail.com',
                'password' => bcrypt('123'),
            ]
        )->assignRole('operator');

        Alternatif::factory()->count(10)->create();

        Kriteria::factory()->count(5)->create();

        AlternatifKriteria::factory()->count(50)->create();
    }
}
