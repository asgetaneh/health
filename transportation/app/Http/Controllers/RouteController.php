<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Route;
use App\Models\Vehicle;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StationOrTown;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RouteStoreRequest;
use App\Http\Requests\RouteUpdateRequest;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Route::class);

        $search = $request->get('search', '');

        $routes = Route::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.routes.index', compact('routes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Route::class);

        $vehicles = Vehicle::pluck('name', 'id');
        $stationOrTowns = StationOrTown::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.routes.create',
            compact('vehicles', 'stationOrTowns', 'stationOrTowns', 'users')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RouteStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Route::class);

        $validated = $request->validated();

        $route = Route::create($validated);

        return redirect()
            ->route('routes.edit', $route)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Route $route): View
    {
        $this->authorize('view', $route);

        return view('app.routes.show', compact('route'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Route $route): View
    {
        $this->authorize('update', $route);

        $vehicles = Vehicle::pluck('name', 'id');
        $stationOrTowns = StationOrTown::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.routes.edit',
            compact(
                'route',
                'vehicles',
                'stationOrTowns',
                'stationOrTowns',
                'users'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RouteUpdateRequest $request,
        Route $route
    ): RedirectResponse {
        $this->authorize('update', $route);

        $validated = $request->validated();

        $route->update($validated);

        return redirect()
            ->route('routes.edit', $route)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Route $route): RedirectResponse
    {
        $this->authorize('delete', $route);

        $route->delete();

        return redirect()
            ->route('routes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
