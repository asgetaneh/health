<?php

namespace App\Http\Controllers;

use App\Models\Diver;
use App\Models\Vehicle;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Vehicle::class);

        $search = $request->get('search', '');

        $vehicles = Vehicle::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.vehicles.index', compact('vehicles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Vehicle::class);

        $divers = Diver::pluck('full_name', 'id');

        return view('app.vehicles.create', compact('divers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Vehicle::class);

        $validated = $request->validated();

        $vehicle = Vehicle::create($validated);

        return redirect()
            ->route('vehicles.edit', $vehicle)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Vehicle $vehicle): View
    {
        $this->authorize('view', $vehicle);

        return view('app.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Vehicle $vehicle): View
    {
        $this->authorize('update', $vehicle);

        $divers = Diver::pluck('full_name', 'id');

        return view('app.vehicles.edit', compact('vehicle', 'divers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        VehicleUpdateRequest $request,
        Vehicle $vehicle
    ): RedirectResponse {
        $this->authorize('update', $vehicle);

        $validated = $request->validated();

        $vehicle->update($validated);

        return redirect()
            ->route('vehicles.edit', $vehicle)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Vehicle $vehicle
    ): RedirectResponse {
        $this->authorize('delete', $vehicle);

        $vehicle->delete();

        return redirect()
            ->route('vehicles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
