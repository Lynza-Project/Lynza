<?php

namespace App\Http\Controllers;

use App\Http\Requests\LostAndFoundCategoryRequest;
use App\Models\LostAndFoundCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class LostAndFoundCategoryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', LostAndFoundCategory::class);

        return LostAndFoundCategory::all();
    }

    public function store(LostAndFoundCategoryRequest $request): LostAndFoundCategory
    {
        $this->authorize('create', LostAndFoundCategory::class);

        return LostAndFoundCategory::create($request->validated());
    }

    public function show(LostAndFoundCategory $lostAndFoundCategory): LostAndFoundCategory
    {
        $this->authorize('view', $lostAndFoundCategory);

        return $lostAndFoundCategory;
    }

    public function update(LostAndFoundCategoryRequest $request, LostAndFoundCategory $lostAndFoundCategory): LostAndFoundCategory
    {
        $this->authorize('update', $lostAndFoundCategory);

        $lostAndFoundCategory->update($request->validated());

        return $lostAndFoundCategory;
    }

    public function destroy(LostAndFoundCategory $lostAndFoundCategory): JsonResponse
    {
        $this->authorize('delete', $lostAndFoundCategory);

        $lostAndFoundCategory->delete();

        return response()->json();
    }
}
