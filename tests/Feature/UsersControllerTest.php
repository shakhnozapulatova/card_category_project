<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CreateUser;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use CreateUser;
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->createUser();

        User::factory()->create([
            'level_access' => 1
        ]);
    }

    private function getUsersList(): \Illuminate\Testing\TestResponse
    {
        return $this->get(route('users.index'),
            [
                'Authorization' => 'Bearer ' . $this->token
            ]
        );
    }

    public function test_logged_in_user_can_view_users_list()
    {
        $response = $this->getUsersList();

        $response->assertStatus(200);

        $response->assertJsonStructure(
            [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'level_access',
                        'email',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]
        );
    }

    public function test_users_list_doesnt_contain_users()
    {
        $response = $this->getUsersList();

        $users = $response->json()['data'];

        $hasOnlyEditors = collect($users)->every(function ($user) {
            return $user['level_access'] === 1;
        });

        $this->assertTrue($hasOnlyEditors);
    }
}
