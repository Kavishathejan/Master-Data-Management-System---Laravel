<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function view(User $user, Category $category)
    {
        return $user->is_admin || $user->id === $category->user_id
            ? Response::allow()
            : Response::deny('You do not own this category.');
    }

    public function update(User $user, Category $category)
    {
        return $user->is_admin || $user->id === $category->user_id
            ? Response::allow()
            : Response::deny('You do not own this category.');
    }

    public function delete(User $user, Category $category)
    {
        return $user->is_admin || $user->id === $category->user_id
            ? Response::allow()
            : Response::deny('You do not own this category.');
    }
}