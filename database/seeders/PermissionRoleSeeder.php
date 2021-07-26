<?php

namespace Database\Seeders;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 6) != 'users_' && substr($permission->title, 0, 6) != 'roles_' && substr($permission->title, 0, 12) != 'permissions_';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
