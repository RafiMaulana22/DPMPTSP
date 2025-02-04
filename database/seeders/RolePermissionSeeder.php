<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'lihat dashboard',
            'mengelola masukan',
            'mengelola pengguna',
            'lihat laporan',
            'analisa data kepuasan'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $operator = Role::firstOrCreate(['name' => 'operator']);

        $admin->givePermissionTo(['lihat dashboard', 'mengelola masukan', 'mengelola pengguna', 'lihat laporan', 'analisa data kepuasan']);
        $operator->givePermissionTo(['lihat dashboard', 'mengelola masukan']);
    }
}
