<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'departure_time' => ['required', 'date'],
            'expected_arrival_time' => ['required', 'date'],
            'tariff' => ['required', 'numeric'],
            'service_charge' => ['required', 'numeric'],
            'departure_station' => ['required', 'exists:station_or_towns,id'],
            'arrival_station' => ['required', 'exists:station_or_towns,id'],
            'user_id' => ['nullable', 'exists:users,id'],
        ];
    }
}
