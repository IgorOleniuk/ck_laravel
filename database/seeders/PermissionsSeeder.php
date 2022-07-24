<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'create_vehicle',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'update_vehicle',
            'guard_name' => 'web'
        ]);

        Permission::create([
            'name' => 'delete_vehicle',
            'guard_name' => 'web'
        ]);
    }
}
