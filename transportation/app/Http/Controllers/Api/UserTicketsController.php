<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketCollection;

class UserTicketsController extends Controller
{
    public function index(Request $request, User $user): TicketCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $tickets = $user
            ->tickets()
            ->search($search)
            ->latest()
            ->paginate();

        return new TicketCollection($tickets);
    }

    public function store(Request $request, User $user): TicketResource
    {
        $this->authorize('create', Ticket::class);

        $validated = $request->validate([
            'route_id' => ['required', 'exists:routes,id'],
            'ticket_number' => ['required', 'max:255', 'string'],
            'customer_name' => ['required', 'max:255', 'string'],
        ]);

        $ticket = $user->tickets()->create($validated);

        return new TicketResource($ticket);
    }
}
