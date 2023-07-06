<?php

namespace App\Http\Requests\Ride;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRidePlacementFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|string|numeric',
            'departure' => 'required|string',
            'destination' => 'required|string',
            'takeoff_time' => 'required|string',
            'available_seat' => 'required|numeric',
            'remaining_seat' => 'required|numeric',
            'date' => 'required|date'
        ];
    }
}
