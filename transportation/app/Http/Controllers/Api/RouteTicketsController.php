<?php

namespace App\Http\Controllers\Api;

use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketCollection;

class RouteTicketsController extends Controller
{
    public function index(Request $request, Route $route): TicketCollection
    {
        $this->authorize('view', $route);

        $search = $request->get('search', '');

        $tickets = $route
            ->tickets()
            ->search($search)
            ->latest()
            ->paginate();

        return new TicketCollection($tickets);
    }

    public function store(Request $request, Route $route): TicketResource
    {
        $this->authorize('create', Ticket::class);

        $validated = $request->validate([
            'ticket_number' => ['required', 'max:255', 'string'],
            'customer_name' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $ticket = $route->tickets()->create($validated);

        return new TicketResource($ticket);
    }
}
