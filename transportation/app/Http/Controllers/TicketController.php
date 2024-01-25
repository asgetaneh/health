<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Route;
use App\Models\Ticket;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Ticket::class);

        $search = $request->get('search', '');

        $tickets = Ticket::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tickets.index', compact('tickets', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Ticket::class);

        $routes = Route::pluck('id', 'id');
        $users = User::pluck('name', 'id');

        return view('app.tickets.create', compact('routes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Ticket::class);

        $validated = $request->validated();

        $ticket = Ticket::create($validated);

        return redirect()
            ->route('tickets.edit', $ticket)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        return view('app.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ticket $ticket): View
    {
        $this->authorize('update', $ticket);

        $routes = Route::pluck('id', 'id');
        $users = User::pluck('name', 'id');

        return view('app.tickets.edit', compact('ticket', 'routes', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TicketUpdateRequest $request,
        Ticket $ticket
    ): RedirectResponse {
        $this->authorize('update', $ticket);

        $validated = $request->validated();

        $ticket->update($validated);

        return redirect()
            ->route('tickets.edit', $ticket)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
