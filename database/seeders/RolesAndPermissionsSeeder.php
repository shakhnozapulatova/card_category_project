<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionsArray = ['assign_editor', 'update_status', 'update_product', 'delete_product',
            'create_attributes', 'update_attributes'];

        $adminRole = $this->createRole('admin');
        $admin = $this->createUser(['name'=> 'admin', 'email' => 'admin@gmail.com', 'password' => 'qwerty123']);
        $admin->assignRole($adminRole);

        $editorRole = $this->createRole('editor');
        $editor = $this->createUser(['name'=> 'editor', 'email' => 'editor@gmail.com', 'password' => 'qwerty123']);
        $editor->assignRole($editorRole);

        foreach ($permissionsArray as $permissionName) {
            $permission = Permission::create([
                'name' => $permissionName,
                'guard_name' => 'api'
            ]);

            $adminRole->givePermissionTo($permission);

            $editorPermissionNames = ['delete_product', 'update_status', 'assign_editor',
                'delete_product', 'create_attributes', 'update_attributes'];

            if (in_array($permissionName, $editorPermissionNames)) {
                continue;
            }

            $editorRole->givePermissionTo($permission);
        }
    }

    /**
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    private function createRole(string $name)
    {
        return Role::create([
            'name' => $name,
        ]);
    }

    private function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }
}
