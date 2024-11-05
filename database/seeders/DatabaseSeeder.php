<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
		
		Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);
        // Define roles and assign existing permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(['view tickets', 'edit tickets', 'delete tickets']);
        
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['view tickets']);
		
		$this->call([
            RoleAndPermissionSeeder::class,
            // Add other seeders if needed
        ]);
    }
}
