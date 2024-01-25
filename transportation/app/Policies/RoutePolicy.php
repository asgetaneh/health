<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Route;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoutePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the route can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list routes');
    }

    /**
     * Determine whether the route can view the model.
     */
    public function view(User $user, Route $model): bool
    {
        return $user->hasPermissionTo('view routes');
    }

    /**
     * Determine whether the route can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create routes');
    }

    /**
     * Determine whether the route can update the model.
     */
    public function update(User $user, Route $model): bool
    {
        return $user->hasPermissionTo('update routes');
    }

    /**
     * Determine whether the route can delete the model.
     */
    public function delete(User $user, Route $model): bool
    {
        return $user->hasPermissionTo('delete routes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete routes');
    }

    /**
     * Determine whether the route can restore the model.
     */
    public function restore(User $user, Route $model): bool
    {
        return false;
    }

    /**
     * Determine whether the route can permanently delete the model.
     */
    public function forceDelete(User $user, Route $model): bool
    {
        return false;
    }
}
