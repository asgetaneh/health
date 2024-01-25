<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore($this->user),
                'max:255',
                'string',
            ],
            'email' => ['required', 'email'],
            'password' => ['nullable'],
            'stationOrTown_id' => ['required', 'exists:station_or_towns,id'],
            'roles' => 'array',
        ];
    }
}
