<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class UsersController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = User::where('level_access',User::EDITOR_LEVEL_ACCESS)->get();

        return UserResource::collection($users);
    }
}
