<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ObservationPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'capybara_id' => 'required|integer|exists:capybaras,id',
            'city_id' => 'required|integer|exists:cities,id',
            'has_hat' => 'required|boolean',
            'observed_at' => [
                'required',
                'date',
                'date_format:Y-m-d',
                'before_or_equal:now',
                Rule::unique('observations', 'observed_at')
                    ->where('capybara_id', $this->capybara_id)
                    ->where('city_id', $this->city_id)
            ]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'observed_at.unique' => 'This capybara has already been recorded in this city on this date. No need to add this record again.'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'capybara_id' => 'capybara',
            'city_id' => 'city',
        ];
    }
}
