<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentationRequest;
use App\Models\Documentation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class DocumentationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Documentation::class);

        return Documentation::all();
    }

    public function store(DocumentationRequest $request): Documentation
    {
        $this->authorize('create', Documentation::class);

        return Documentation::create($request->validated());
    }

    public function show(Documentation $documentation): Documentation
    {
        $this->authorize('view', $documentation);

        return $documentation;
    }

    public function update(DocumentationRequest $request, Documentation $documentation): Documentation
    {
        $this->authorize('update', $documentation);

        $documentation->update($request->validated());

        return $documentation;
    }

    public function destroy(Documentation $documentation): JsonResponse
    {
        $this->authorize('delete', $documentation);

        $documentation->delete();

        return response()->json();
    }
}
