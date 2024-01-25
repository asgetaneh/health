<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\StationOrTown;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StationOrTownStoreRequest;
use App\Http\Requests\StationOrTownUpdateRequest;

class StationOrTownController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', StationOrTown::class);

        $search = $request->get('search', '');

        $stationOrTowns = StationOrTown::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.station_or_towns.index',
            compact('stationOrTowns', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', StationOrTown::class);

        return view('app.station_or_towns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StationOrTownStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', StationOrTown::class);

        $validated = $request->validated();

        $stationOrTown = StationOrTown::create($validated);

        return redirect()
            ->route('station-or-towns.edit', $stationOrTown)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, StationOrTown $stationOrTown): View
    {
        $this->authorize('view', $stationOrTown);

        return view('app.station_or_towns.show', compact('stationOrTown'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, StationOrTown $stationOrTown): View
    {
        $this->authorize('update', $stationOrTown);

        return view('app.station_or_towns.edit', compact('stationOrTown'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        StationOrTownUpdateRequest $request,
        StationOrTown $stationOrTown
    ): RedirectResponse {
        $this->authorize('update', $stationOrTown);

        $validated = $request->validated();

        $stationOrTown->update($validated);

        return redirect()
            ->route('station-or-towns.edit', $stationOrTown)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        StationOrTown $stationOrTown
    ): RedirectResponse {
        $this->authorize('delete', $stationOrTown);

        $stationOrTown->delete();

        return redirect()
            ->route('station-or-towns.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
