<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeRequest;
use App\Models\Theme;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ThemeController extends Controller
{
    use AuthorizesRequests;

    /**
     * @return Collection<int, Theme>
     */
    public function index(): Collection
    {
        $this->authorize('viewAny', Theme::class);

        return Theme::all();
    }

    public function store(ThemeRequest $request): Theme
    {
        $this->authorize('create', Theme::class);

        return Theme::create($request->validated());
    }

    public function show(Theme $theme): Theme
    {
        $this->authorize('view', $theme);

        return $theme;
    }

    public function update(ThemeRequest $request, Theme $theme): Theme
    {
        $this->authorize('update', $theme);

        $theme->update($request->validated());

        return $theme;
    }

    public function destroy(Theme $theme): JsonResponse
    {
        $this->authorize('delete', $theme);

        $theme->delete();

        return response()->json();
    }
}
