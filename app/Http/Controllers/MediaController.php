<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Models\Media;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class MediaController extends Controller
{
    use AuthorizesRequests;

    /**
     * @return Collection<int, Media>
     */
    public function index(): Collection
    {
        $this->authorize('viewAny', Media::class);

        return Media::all();
    }

    public function store(MediaRequest $request): Media
    {
        $this->authorize('create', Media::class);

        return Media::create($request->validated());
    }

    public function show(Media $media): Media
    {
        $this->authorize('view', $media);

        return $media;
    }

    public function update(MediaRequest $request, Media $media): Media
    {
        $this->authorize('update', $media);

        $media->update($request->validated());

        return $media;
    }

    public function destroy(Media $media): JsonResponse
    {
        $this->authorize('delete', $media);

        $media->delete();

        return response()->json();
    }
}
