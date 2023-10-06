<?php

namespace App\Http\Controllers;

use App\Models\Capybara;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;

class CapybaraController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Capybara::orderBy('created_at', 'DESC')->get());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validatedInput = $this->validated($request);

        $capybara = Capybara::create($validatedInput);

        return response()->json(
            $capybara,
            201
        );
    }

    /**
     * @param Capybara $capybara
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Capybara $capybara, Request $request): JsonResponse
    {
        $validatedInput = $this->validated($request, $capybara);

        $capybara->update($validatedInput);

        return response()->json($capybara);
    }

    /**
     * @param Capybara $capybara
     * @return JsonResponse
     */
    public function delete(Capybara $capybara): JsonResponse
    {
        $capybara->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * @param Request $request
     * @param Capybara|null $capybara
     * @return array<string, string>
     */
    protected function validated(Request $request, ?Capybara $capybara = null): array
    {
        return $request->validate([
            'name' => [
                'required', 'string', 'max:255',
                $capybara ? Rule::unique('capybaras')->ignore($capybara->id) : 'unique:capybaras'
            ],
            'hex_color' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'height_inches' => 'required|integer|max:100',
            'length_inches' => 'required|integer|max:100',
        ]);
    }
}
