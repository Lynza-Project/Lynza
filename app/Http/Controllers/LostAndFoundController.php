<?php

namespace App\Http\Controllers;

use App\Http\Requests\LostAndFoundRequest;
use App\Models\LostAndFound;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class LostAndFoundController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', LostAndFound::class);

        return LostAndFound::all();
    }

    public function store(LostAndFoundRequest $request): LostAndFound
    {
        $this->authorize('create', LostAndFound::class);

        return LostAndFound::create($request->validated());
    }

    public function show(LostAndFound $lostAndFound): LostAndFound
    {
        $this->authorize('view', $lostAndFound);

        return $lostAndFound;
    }

    public function update(LostAndFoundRequest $request, LostAndFound $lostAndFound): LostAndFound
    {
        $this->authorize('update', $lostAndFound);

        $lostAndFound->update($request->validated());

        return $lostAndFound;
    }

    public function destroy(LostAndFound $lostAndFound): JsonResponse
    {
        $this->authorize('delete', $lostAndFound);

        $lostAndFound->delete();

        return response()->json();
    }
}
