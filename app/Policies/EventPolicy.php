<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function viewAny(): bool
    {
        return true;
    }

    public function view(User $user, Event $event): bool
    {
        return $user->organization_id === $event->organization_id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'super-admin']);
    }

    public function update(User $user, Event $event): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $event->organization_id);
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $event->organization_id);
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
