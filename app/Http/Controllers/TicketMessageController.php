<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketMessageRequest;
use App\Models\TicketMessage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class TicketMessageController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', TicketMessage::class);

        return TicketMessage::all();
    }

    public function store(TicketMessageRequest $request): TicketMessage
    {
        $this->authorize('create', TicketMessage::class);

        return TicketMessage::create($request->validated());
    }

    public function show(TicketMessage $ticketMessage): TicketMessage
    {
        $this->authorize('view', $ticketMessage);

        return $ticketMessage;
    }

    public function update(TicketMessageRequest $request, TicketMessage $ticketMessage): TicketMessage
    {
        $this->authorize('update', $ticketMessage);

        $ticketMessage->update($request->validated());

        return $ticketMessage;
    }

    public function destroy(TicketMessage $ticketMessage): JsonResponse
    {
        $this->authorize('delete', $ticketMessage);

        $ticketMessage->delete();

        return response()->json();
    }
}
