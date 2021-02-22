<?php


namespace Tests\Feature\Traits;


use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait CreateUser
{
    private $token;

    public function createUser() : void
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $this->token = auth()->tokenById($user->id);
    }

    public function getAdminToken()
    {
        $user = User::factory()->create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        $adminRole->givePermissionTo('edit articles');
    }

    public function createPermissions()
    {
        $permissionsArray = ['assign_editor', 'update_status', 'update_product', 'delete_product', 'edit_product',
            'create_attributes', 'update_attributes'];

        foreach ($permissionsArray as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }
    }
}
