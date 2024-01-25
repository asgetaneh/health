<?php

namespace App\Http\Controllers;

use App\Models\Diver;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DiverStoreRequest;
use App\Http\Requests\DiverUpdateRequest;

class DiverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Diver::class);

        $search = $request->get('search', '');

        $divers = Diver::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.divers.index', compact('divers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Diver::class);

        return view('app.divers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiverStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Diver::class);

        $validated = $request->validated();

        $diver = Diver::create($validated);

        return redirect()
            ->route('divers.edit', $diver)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Diver $diver): View
    {
        $this->authorize('view', $diver);

        return view('app.divers.show', compact('diver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Diver $diver): View
    {
        $this->authorize('update', $diver);

        return view('app.divers.edit', compact('diver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DiverUpdateRequest $request,
        Diver $diver
    ): RedirectResponse {
        $this->authorize('update', $diver);

        $validated = $request->validated();

        $diver->update($validated);

        return redirect()
            ->route('divers.edit', $diver)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Diver $diver): RedirectResponse
    {
        $this->authorize('delete', $diver);

        $diver->delete();

        return redirect()
            ->route('divers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
