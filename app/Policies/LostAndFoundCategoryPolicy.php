<?php

namespace App\Policies;

use App\Models\LostAndFoundCategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LostAndFoundCategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function update(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function delete(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function restore(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function forceDelete(User $user): bool
    {
        return $user->role === 'super-admin';
    }
}
