<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            'manage users',
            'manage tickets',
            'view sensitive data',
            // Add other permissions as needed
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $supportRole = Role::create(['name' => 'support']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($permissions);
        $supportRole->givePermissionTo('manage tickets');
    }
}
