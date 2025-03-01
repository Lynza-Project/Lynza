<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function view(User $user, Ticket $ticket): bool
    {
        return $user->role === 'super-admin' || (($user->organization->id === $ticket->organization->id && ($user->role === 'admin')) || $user->id === $ticket->user_id);
    }

    public function create(): bool
    {
        return true;
    }

    public function update(User $user, Ticket $ticket): bool
    {
        return $user->role === 'super-admin' || (($user->organization->id === $ticket->organization->id && ($user->role === 'admin')) || $user->id === $ticket->user_id);
    }

    public function delete(User $user, Ticket $ticket): bool
    {
        return $user->role === 'super-admin' || (($user->organization->id === $ticket->organization->id && ($user->role === 'admin')) || $user->id === $ticket->user_id);
    }

    public function restore(User $user, Ticket $ticket): bool
    {
        return $user->role === 'super-admin';
    }

    public function forceDelete(User $user, Ticket $ticket): bool
    {
        return $user->role === 'super-admin';
    }
}
