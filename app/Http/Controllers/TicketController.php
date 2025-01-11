<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Ticket::class);

        return Ticket::all();
    }

    public function store(TicketRequest $request): Ticket
    {
        $this->authorize('create', Ticket::class);

        return Ticket::create($request->validated());
    }

    public function show(Ticket $ticket): Ticket
    {
        $this->authorize('view', $ticket);

        return $ticket;
    }

    public function update(TicketRequest $request, Ticket $ticket): Ticket
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->validated());

        return $ticket;
    }

    public function destroy(Ticket $ticket): JsonResponse
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return response()->json();
    }
}
