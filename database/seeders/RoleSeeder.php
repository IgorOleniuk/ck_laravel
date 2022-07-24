<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $admin->givePermissionTo(['create_vehicle', 'update_vehicle', 'delete_vehicle']);

        Role::create([
            'name' => 'Client',
            'guard_name' => 'web'
        ]);
    }
}
