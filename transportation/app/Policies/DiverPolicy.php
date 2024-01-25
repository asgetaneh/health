<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Diver;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiverPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the diver can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list divers');
    }

    /**
     * Determine whether the diver can view the model.
     */
    public function view(User $user, Diver $model): bool
    {
        return $user->hasPermissionTo('view divers');
    }

    /**
     * Determine whether the diver can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create divers');
    }

    /**
     * Determine whether the diver can update the model.
     */
    public function update(User $user, Diver $model): bool
    {
        return $user->hasPermissionTo('update divers');
    }

    /**
     * Determine whether the diver can delete the model.
     */
    public function delete(User $user, Diver $model): bool
    {
        return $user->hasPermissionTo('delete divers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete divers');
    }

    /**
     * Determine whether the diver can restore the model.
     */
    public function restore(User $user, Diver $model): bool
    {
        return false;
    }

    /**
     * Determine whether the diver can permanently delete the model.
     */
    public function forceDelete(User $user, Diver $model): bool
    {
        return false;
    }
}
