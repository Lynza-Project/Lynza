<?php

namespace App\Policies;

use App\Models\Address;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function view(User $user, Address $address): bool
    {
        return $user->role === 'super-admin' || $user->organization->id === $address->organization->id;
    }

    public function create(User $user): bool
    {
        return $user->role === 'super-admin' || $user->role === 'admin';
    }

    public function update(User $user, Address $address): bool
    {
        return $user->role === 'super-admin' || $user->organization->id === $address->organization->id;
    }

    public function delete(User $user, Address $address): bool
    {
        return $user->role === 'super-admin' || $user->organization->id === $address->organization->id;
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
