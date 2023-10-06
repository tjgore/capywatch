<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Capybara;
use App\Models\Observation;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ObservationPostRequest;

class ObservationController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $observations = Observation::orderBy('observed_at', 'DESC')->with(['capybara:id,name', 'city:id,name'])->get();
        return response()->json($observations);
    }

    /**
     * @param ObservationPostRequest $request
     * @return JsonResponse
     */
    public function store(ObservationPostRequest $request): JsonResponse
    {
        $validatedInput = $request->validated();

        $observation = Observation::create($validatedInput);

        return response()->json([
            $observation
        ], 201);
    }

    /**
     * Get the cities and capybaras for the create form.
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $cities = City::all();
        $capybaras = Capybara::all();

        return response()->json([
            'cities' => $cities,
            'capybaras' => $capybaras
        ]);
    }

    /**
     * @param ObservationPostRequest $request
     * @param Observation $observation
     * @return JsonResponse
     */
    public function update(ObservationPostRequest $request, Observation $observation): JsonResponse
    {
        $validatedInput = $request->validated();

        $observation->update($validatedInput);

        return response()->json([
            $observation
        ]);
    }

    /**
     * @param Observation $observation
     * @return JsonResponse
     */
    public function delete(Observation $observation): JsonResponse
    {
        $observation->delete();

        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
