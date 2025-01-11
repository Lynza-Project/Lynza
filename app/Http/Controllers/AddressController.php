<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Address::class);

        return Address::all();
    }

    public function store(AddressRequest $request): Address
    {
        $this->authorize('create', Address::class);

        return Address::create($request->validated());
    }

    public function show(Address $address): Address
    {
        $this->authorize('view', $address);

        return $address;
    }

    public function update(AddressRequest $request, Address $address): Address
    {
        $this->authorize('update', $address);

        $address->update($request->validated());

        return $address;
    }

    public function destroy(Address $address): JsonResponse
    {
        $this->authorize('delete', $address);

        $address->delete();

        return response()->json();
    }
}
