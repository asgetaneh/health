<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list divers']);
        Permission::create(['name' => 'view divers']);
        Permission::create(['name' => 'create divers']);
        Permission::create(['name' => 'update divers']);
        Permission::create(['name' => 'delete divers']);

        Permission::create(['name' => 'list routes']);
        Permission::create(['name' => 'view routes']);
        Permission::create(['name' => 'create routes']);
        Permission::create(['name' => 'update routes']);
        Permission::create(['name' => 'delete routes']);

        Permission::create(['name' => 'list stationortowns']);
        Permission::create(['name' => 'view stationortowns']);
        Permission::create(['name' => 'create stationortowns']);
        Permission::create(['name' => 'update stationortowns']);
        Permission::create(['name' => 'delete stationortowns']);

        Permission::create(['name' => 'list tickets']);
        Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'update tickets']);
        Permission::create(['name' => 'delete tickets']);

        Permission::create(['name' => 'list vehicles']);
        Permission::create(['name' => 'view vehicles']);
        Permission::create(['name' => 'create vehicles']);
        Permission::create(['name' => 'update vehicles']);
        Permission::create(['name' => 'delete vehicles']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
