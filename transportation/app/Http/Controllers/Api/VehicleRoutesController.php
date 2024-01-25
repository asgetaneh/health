<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Http\Resources\RouteCollection;

class VehicleRoutesController extends Controller
{
    public function index(Request $request, Vehicle $vehicle): RouteCollection
    {
        $this->authorize('view', $vehicle);

        $search = $request->get('search', '');

        $routes = $vehicle
            ->routes()
            ->search($search)
            ->latest()
            ->paginate();

        return new RouteCollection($routes);
    }

    public function store(Request $request, Vehicle $vehicle): RouteResource
    {
        $this->authorize('create', Route::class);

        $validated = $request->validate([
            'departure_time' => ['required', 'date'],
            'expected_arrival_time' => ['required', 'date'],
            'tariff' => ['required', 'numeric'],
            'service_charge' => ['required', 'numeric'],
            'departure_station' => ['required', 'exists:station_or_towns,id'],
            'arrival_station' => ['required', 'exists:station_or_towns,id'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $route = $vehicle->routes()->create($validated);

        return new RouteResource($route);
    }
}
