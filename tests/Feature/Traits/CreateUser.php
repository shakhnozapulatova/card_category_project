<?php


namespace Tests\Feature\Traits;


use App\Models\User;

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
}
