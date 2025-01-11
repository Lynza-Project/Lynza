<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Documentation;

class DocumentationPolicy
{
    public function viewAny(): true
    {
        return true;
    }

    public function view(User $user, Documentation $documentation): bool
    {
        return $user->organization_id === $documentation->organization_id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'super-admin']);
    }

    public function update(User $user, Documentation $documentation): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $documentation->organization_id);
    }

    public function delete(User $user, Documentation $documentation): bool
    {
        return $user->role === 'super-admin' || ($user->role === 'admin' && $user->organization_id === $documentation->organization_id);
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
