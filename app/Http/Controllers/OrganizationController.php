<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class OrganizationController extends Controller
{
    use AuthorizesRequests;

    /**
     * @return Collection<int, Organization>
     */
    public function index(): Collection
    {
        $this->authorize('viewAny', Organization::class);

        return Organization::all();
    }

    public function store(OrganizationRequest $request): Organization
    {
        $this->authorize('create', Organization::class);

        return Organization::create($request->validated());
    }

    public function show(Organization $organization): Organization
    {
        $this->authorize('view', $organization);

        return $organization;
    }

    public function update(OrganizationRequest $request, Organization $organization): Organization
    {
        $this->authorize('update', $organization);

        $organization->update($request->validated());

        return $organization;
    }

    public function destroy(Organization $organization): JsonResponse
    {
        $this->authorize('delete', $organization);

        $organization->delete();

        return response()->json();
    }
}
