<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(User $user, Organization $organization): bool
    {
        return $user->organization_id === $organization->id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'super-admin']);
    }

    public function update(User $user, Organization $organization): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $organization->id);
    }

    public function delete(User $user, Organization $organization): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $organization->id);
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
