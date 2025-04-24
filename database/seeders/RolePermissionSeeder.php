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
            'create pertanyaan',
            'view pertanyaan',
            'edit pertanyaan',
            'update pertanyaan',
            'delete pertanyaan',
            'view pilihan',
            'create pilihan',
            'edit pilihan',
            'update pilihan',
            'delete pilihan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $operator = Role::firstOrCreate(['name' => 'operator']);

        $admin->givePermissionTo(['create pertanyaan', 'view pertanyaan', 'edit pertanyaan', 'update pertanyaan', 'delete pertanyaan', 'view pilihan', 'create pilihan', 'edit pilihan', 'update pilihan', 'delete pilihan']);
        $operator->givePermissionTo(['lihat dashboard', 'mengelola masukan']);
    }
}
