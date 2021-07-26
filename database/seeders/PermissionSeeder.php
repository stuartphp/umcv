<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'users_management_access',
            'users_access',
            'users_create',
            'users_read',
            'users_update',
            'users_delete',
            'roles_access',
            'roles_create',
            'roles_read',
            'roles_update',
            'roles_delete',
            'permissions_access',
            'permissions_create',
            'permissions_read',
            'permissions_update',
            'permissions_delete'

        ];
        foreach($permissions as $permission)
        {
            Permission::create(['title'=>$permission]);
        }
    }
}
