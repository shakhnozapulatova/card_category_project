<?php


namespace App\Services;


use App\DataTransferObjects\UserDto;
use App\Models\User;

class UserService
{
    public function create(UserDto $dto)
    {
        return User::create([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => bcrypt($dto->getPassword())
        ]);
    }

    /**
     * @param $id
     * @param UserDto $dto
     * @return User|User[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function update($id, UserDto $dto)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $dto->getName(),
            'email' => $dto->getEmail(),
            'password' => $dto->getPassword()
        ]);

        $user->fresh();

        return $user;
    }
}
