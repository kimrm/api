<?php

namespace App\Policies;

use App\Models\User;

class ProductCategoryPolicy
{
    public function modify(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user)
    {
        return $user->is_admin;
    }

    public function delete(User $user)
    {
        return $user->is_admin;
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }
}
