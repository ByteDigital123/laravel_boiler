<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create([
            'name' => 'create_admin_user',
            'label' => 'Create Admin User',
            'model' => 'Admin User'
        ]);
        Permission::create([
            'name' => 'list_admin_user',
            'label' => 'List Admin User',
            'model' => 'Admin User'
        ]);
        Permission::create([
            'name' => 'view_admin_user',
            'label' => 'View Admin User',
            'model' => 'Admin User'
        ]);
        Permission::create([
            'name' => 'update_admin_user',
            'label' => 'Update Admin User',
            'model' => 'Admin User'
        ]);
        Permission::create([
            'name' => 'delete_admin_user',
            'label' => 'Delete Admin User',
            'model' => 'Admin User'
        ]);



        // create roles
        Permission::create([
            'name' => 'create_role',
            'label' => 'Create Role',
            'model' => 'Role'
        ]);
        Permission::create([
            'name' => 'list_role',
            'label' => 'View Role',
            'model' => 'Role'
        ]);

        Permission::create([
            'name' => 'view_role',
            'label' => 'View Role',
            'model' => 'Role'
        ]);

        Permission::create([
            'name' => 'update_role',
            'label' => 'Update Role',
            'model' => 'Role'
        ]);
        Permission::create([
            'name' => 'delete_role',
            'label' => 'Delete Role',
            'model' => 'Role'
        ]);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(['view_admin_user']);
    }
}
