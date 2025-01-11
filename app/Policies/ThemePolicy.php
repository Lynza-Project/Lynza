<?php

namespace App\Policies;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThemePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function view(User $user, Theme $theme): bool
    {
        return $user->role === 'super-admin' || $user->organization->id === $theme->organization->id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'super-admin' || $user->role === 'admin';
    }

    public function update(User $user, Theme $theme): bool
    {
        return $user->role === 'super-admin' || $user->organization->id === $theme->organization->id;
    }

    public function delete(User $user, Theme $theme): bool
    {
        return $user->role === 'super-admin' || $user->organization->id === $theme->organization->id;
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
