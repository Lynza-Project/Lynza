<?php

namespace App\Policies;

use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketMessagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->role === 'super-admin';
    }

    public function view(User $user, TicketMessage $ticketMessage): bool
    {
        return $user->role === 'super-admin' || ((($user->organization->id === $ticketMessage->ticket->organization->id && ($user->role === 'admin')) || $user->id === $ticketMessage->user_id));
    }

    public function create(): bool
    {
        return true;
    }

    public function update(User $user, TicketMessage $ticketMessage): bool
    {
        return $user->role === 'super-admin' || ((($user->organization->id === $ticketMessage->ticket->organization->id && ($user->role === 'admin')) || $user->id === $ticketMessage->user_id));
    }

    public function delete(User $user, TicketMessage $ticketMessage): bool
    {
        return $user->role === 'super-admin' || ((($user->organization->id === $ticketMessage->ticket->organization->id && ($user->role === 'admin')) || $user->id === $ticketMessage->user_id));
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
