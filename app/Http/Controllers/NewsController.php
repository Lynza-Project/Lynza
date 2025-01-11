<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', News::class);

        return News::all();
    }

    public function store(NewsRequest $request): News
    {
        $this->authorize('create', News::class);

        return News::create($request->validated());
    }

    public function show(News $new): News
    {
        $this->authorize('view', $new);

        return $new;
    }

    public function update(NewsRequest $request, News $new): News
    {
        $this->authorize('update', $new);

        $new->update($request->validated());

        return $new;
    }

    public function destroy(News $new): JsonResponse
    {
        $this->authorize('delete', $new);

        $new->delete();

        return response()->json();
    }
}
