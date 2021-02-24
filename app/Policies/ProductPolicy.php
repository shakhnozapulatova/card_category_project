<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Product $product) : bool
    {
        return $user->isAdmin() || $product->editor_id === $user->id;
    }

    public function update(User $user, int $editorId = null) : bool
    {
        return $user->isAdmin() || $editorId === $user->id;
    }

    public function delete(User $user): bool
    {
        return $user->isAdmin();
    }
}
