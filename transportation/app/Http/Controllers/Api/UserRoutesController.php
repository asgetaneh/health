<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Http\Resources\RouteCollection;

class UserRoutesController extends Controller
{
    public function index(Request $request, User $user): RouteCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $routes = $user
            ->routes()
            ->search($search)
            ->latest()
            ->paginate();

        return new RouteCollection($routes);
    }

    public function store(Request $request, User $user): RouteResource
    {
        $this->authorize('create', Route::class);

        $validated = $request->validate([
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'departure_time' => ['required', 'date'],
            'expected_arrival_time' => ['required', 'date'],
            'tariff' => ['required', 'numeric'],
            'service_charge' => ['required', 'numeric'],
            'departure_station' => ['required', 'exists:station_or_towns,id'],
            'arrival_station' => ['required', 'exists:station_or_towns,id'],
        ]);

        $route = $user->routes()->create($validated);

        return new RouteResource($route);
    }
}
