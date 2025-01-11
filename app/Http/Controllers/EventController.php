<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Event::class);

        return Event::all();
    }

    public function store(EventRequest $request): Event
    {
        $this->authorize('create', Event::class);

        return Event::create($request->validated());
    }

    public function show(Event $event): Event
    {
        $this->authorize('view', $event);

        return $event;
    }

    public function update(EventRequest $request, Event $event): Event
    {
        $this->authorize('update', $event);

        $event->update($request->validated());

        return $event;
    }

    public function destroy(Event $event): JsonResponse
    {
        $this->authorize('delete', $event);

        $event->delete();

        return response()->json();
    }
}
