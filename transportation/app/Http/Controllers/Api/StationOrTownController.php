<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\StationOrTown;
use App\Http\Controllers\Controller;
use App\Http\Resources\StationOrTownResource;
use App\Http\Resources\StationOrTownCollection;
use App\Http\Requests\StationOrTownStoreRequest;
use App\Http\Requests\StationOrTownUpdateRequest;

class StationOrTownController extends Controller
{
    public function index(Request $request): StationOrTownCollection
    {
        $this->authorize('view-any', StationOrTown::class);

        $search = $request->get('search', '');

        $stationOrTowns = StationOrTown::search($search)
            ->latest()
            ->paginate();

        return new StationOrTownCollection($stationOrTowns);
    }

    public function store(
        StationOrTownStoreRequest $request
    ): StationOrTownResource {
        $this->authorize('create', StationOrTown::class);

        $validated = $request->validated();

        $stationOrTown = StationOrTown::create($validated);

        return new StationOrTownResource($stationOrTown);
    }

    public function show(
        Request $request,
        StationOrTown $stationOrTown
    ): StationOrTownResource {
        $this->authorize('view', $stationOrTown);

        return new StationOrTownResource($stationOrTown);
    }

    public function update(
        StationOrTownUpdateRequest $request,
        StationOrTown $stationOrTown
    ): StationOrTownResource {
        $this->authorize('update', $stationOrTown);

        $validated = $request->validated();

        $stationOrTown->update($validated);

        return new StationOrTownResource($stationOrTown);
    }

    public function destroy(
        Request $request,
        StationOrTown $stationOrTown
    ): Response {
        $this->authorize('delete', $stationOrTown);

        $stationOrTown->delete();

        return response()->noContent();
    }
}
