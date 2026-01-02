<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles & permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions
        $permissions = [
            'manage users',
            'approve orders',
            'create product',
            'view orders',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $alpha = Role::firstOrCreate(['name' => 'alpha']); // Super Admin
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $supplier = Role::firstOrCreate(['name' => 'supplier']);
        $rider = Role::firstOrCreate(['name' => 'rider']);
        $customer = Role::firstOrCreate(['name' => 'customer']);

        // Assign permissions
        // $alpha->givePermissionTo(Permission::all());

        // $admin->givePermissionTo([
        //     'manage users',
        //     'approve orders',
        // ]);

        // $supplier->givePermissionTo('create product');
        // $rider->givePermissionTo('view orders');
    }
}
