<?php

namespace App\Policies;

use App\Models\LostAndFound;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LostAndFoundPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(User $user, LostAndFound $lostAndFound): bool
    {
        return $user->organization_id === $lostAndFound->organization_id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'super-admin']);
    }

    public function update(User $user, LostAndFound $lostAndFound): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $lostAndFound->organization_id);
    }

    public function delete(User $user, LostAndFound $lostAndFound): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $lostAndFound->organization_id);
    }

    public function restore(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function forceDelete(User $user, LostAndFound $lostAndFound): bool
    {
        return $user->role === 'super-admin';
    }
}
