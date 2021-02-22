<?php

namespace Tests\Feature\Services;

use App\DataTransferObjects\UserDto;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var UserDto
     */
    private $userDto;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userService = new UserService();

        $this->userDto = new UserDto(
            $this->faker->name,
            $this->faker->email,
            $this->faker->password
        );
    }

    public function test_can_create_user()
    {
        $user = $this->userService->create($this->userDto);

        $this->assertDatabaseHas('users', $user->toArray());
        $this->assertDatabaseCount('users', 1);
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();
        $user = $this->userService->update($user->id, $this->userDto);

        $this->assertDatabaseHas('users', $user->toArray());
        $this->assertDatabaseCount('users', 1);
    }
}
