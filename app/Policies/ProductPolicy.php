<?php
namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['admin', 'user']);
    }

    public function view(User $user, Product $product)
    {
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }

    public function create(User $user)
    {
        return $user->hasAnyRole(['admin', 'user']);
    }

    public function update(User $user, Product $product)
    {
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }

    public function delete(User $user, Product $product)
    {
        return $user->hasRole('admin') || $user->id === $product->user_id;
    }
}
