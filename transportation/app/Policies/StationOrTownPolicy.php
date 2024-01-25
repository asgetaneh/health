<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StationOrTown;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationOrTownPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the stationOrTown can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list stationortowns');
    }

    /**
     * Determine whether the stationOrTown can view the model.
     */
    public function view(User $user, StationOrTown $model): bool
    {
        return $user->hasPermissionTo('view stationortowns');
    }

    /**
     * Determine whether the stationOrTown can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create stationortowns');
    }

    /**
     * Determine whether the stationOrTown can update the model.
     */
    public function update(User $user, StationOrTown $model): bool
    {
        return $user->hasPermissionTo('update stationortowns');
    }

    /**
     * Determine whether the stationOrTown can delete the model.
     */
    public function delete(User $user, StationOrTown $model): bool
    {
        return $user->hasPermissionTo('delete stationortowns');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete stationortowns');
    }

    /**
     * Determine whether the stationOrTown can restore the model.
     */
    public function restore(User $user, StationOrTown $model): bool
    {
        return false;
    }

    /**
     * Determine whether the stationOrTown can permanently delete the model.
     */
    public function forceDelete(User $user, StationOrTown $model): bool
    {
        return false;
    }
}
