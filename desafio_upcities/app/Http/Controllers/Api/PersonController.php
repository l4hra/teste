<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdatePersonRequest;
use App\Models\Person;
use App\Http\Requests\StorePersonRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Person::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request): JsonResponse
    {
        $person = Person::create($request->validated());
        return response()->json($person, 201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person): JsonResponse
    {
        return response()->json($person);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonRequest $request, Person $person): JsonResponse
    {
        $person->update($request->validated());
        return response()->json($person);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person): JsonResponse
    {
        $person->delete();
        return response()->json(null, 204);
    }
}
