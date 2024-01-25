<?php

namespace App\Http\Controllers\Api;

use App\Models\Diver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiverResource;
use App\Http\Resources\DiverCollection;
use App\Http\Requests\DiverStoreRequest;
use App\Http\Requests\DiverUpdateRequest;

class DiverController extends Controller
{
    public function index(Request $request): DiverCollection
    {
        $this->authorize('view-any', Diver::class);

        $search = $request->get('search', '');

        $divers = Diver::search($search)
            ->latest()
            ->paginate();

        return new DiverCollection($divers);
    }

    public function store(DiverStoreRequest $request): DiverResource
    {
        $this->authorize('create', Diver::class);

        $validated = $request->validated();

        $diver = Diver::create($validated);

        return new DiverResource($diver);
    }

    public function show(Request $request, Diver $diver): DiverResource
    {
        $this->authorize('view', $diver);

        return new DiverResource($diver);
    }

    public function update(
        DiverUpdateRequest $request,
        Diver $diver
    ): DiverResource {
        $this->authorize('update', $diver);

        $validated = $request->validated();

        $diver->update($validated);

        return new DiverResource($diver);
    }

    public function destroy(Request $request, Diver $diver): Response
    {
        $this->authorize('delete', $diver);

        $diver->delete();

        return response()->noContent();
    }
}
