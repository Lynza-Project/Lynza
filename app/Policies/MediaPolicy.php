<?php

namespace App\Policies;

use App\Models\Media;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Media $media): bool
    {
        return $user->organization_id === $media->model->organization_id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'super-admin']);
    }

    public function update(User $user, Media $media): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $media->model->organization_id);
    }

    public function delete(User $user, Media $media): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $media->model->organization_id);
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
