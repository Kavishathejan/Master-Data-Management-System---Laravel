<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BrandPolicy
{
    public function view(User $user, Brand $brand)
    {
        return $user->is_admin || $user->id === $brand->user_id
            ? Response::allow()
            : Response::deny('You do not own this brand.');
    }

    public function update(User $user, Brand $brand)
    {
        return $user->is_admin || $user->id === $brand->user_id
            ? Response::allow()
            : Response::deny('You do not own this brand.');
    }

    public function delete(User $user, Brand $brand)
    {
        return $user->is_admin || $user->id === $brand->user_id
            ? Response::allow()
            : Response::deny('You do not own this brand.');
    }
}