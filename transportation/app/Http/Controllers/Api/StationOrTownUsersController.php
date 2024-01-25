<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\StationOrTown;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class StationOrTownUsersController extends Controller
{
    public function index(
        Request $request,
        StationOrTown $stationOrTown
    ): UserCollection {
        $this->authorize('view', $stationOrTown);

        $search = $request->get('search', '');

        $users = $stationOrTown
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(
        Request $request,
        StationOrTown $stationOrTown
    ): UserResource {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'username' => [
                'required',
                'unique:users,username',
                'max:255',
                'string',
            ],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $stationOrTown->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}
