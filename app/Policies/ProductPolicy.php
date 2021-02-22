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
        return $user->hasRole(['admin']) || $product->editor_id === $user->id;
    }

    public function update(User $user, Product $product) : bool
    {
        return $user->hasRole(['admin']) || $product->editor_id === $user->id;
    }

    public function delete(User $user): bool
    {
        return $user->hasRole(['admin']);
    }
}
