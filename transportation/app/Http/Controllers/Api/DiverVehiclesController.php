<?php

namespace App\Http\Controllers\Api;

use App\Models\Diver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VehicleResource;
use App\Http\Resources\VehicleCollection;

class DiverVehiclesController extends Controller
{
    public function index(Request $request, Diver $diver): VehicleCollection
    {
        $this->authorize('view', $diver);

        $search = $request->get('search', '');

        $vehicles = $diver
            ->vehicles()
            ->search($search)
            ->latest()
            ->paginate();

        return new VehicleCollection($vehicles);
    }

    public function store(Request $request, Diver $diver): VehicleResource
    {
        $this->authorize('create', Vehicle::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'plante_number' => ['required', 'max:255'],
            'level' => ['required', 'numeric'],
            'total_seats' => ['required', 'numeric'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $vehicle = $diver->vehicles()->create($validated);

        return new VehicleResource($vehicle);
    }
}
