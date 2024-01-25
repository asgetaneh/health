<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\StationOrTown;
use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Http\Resources\RouteCollection;

class StationOrTownRoutesController extends Controller
{
    public function index(
        Request $request,
        StationOrTown $stationOrTown
    ): RouteCollection {
        $this->authorize('view', $stationOrTown);

        $search = $request->get('search', '');

        $routes = $stationOrTown
            ->routes2()
            ->search($search)
            ->latest()
            ->paginate();

        return new RouteCollection($routes);
    }

    public function store(
        Request $request,
        StationOrTown $stationOrTown
    ): RouteResource {
        $this->authorize('create', Route::class);

        $validated = $request->validate([
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'departure_time' => ['required', 'date'],
            'expected_arrival_time' => ['required', 'date'],
            'tariff' => ['required', 'numeric'],
            'service_charge' => ['required', 'numeric'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $route = $stationOrTown->routes2()->create($validated);

        return new RouteResource($route);
    }
}
