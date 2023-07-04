<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVehicleFormRequest extends FormRequest
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
            'brand' => 'required|string',
            'colour' => 'required|string',
            'registration_no' => 'required|string',
            'car_model' => 'required|string',
            'user_id' => 'required|string|exists:users,id',
            'air_condition' => 'required|string',
            'manufacture_year' => 'required|numeric|digits:4',
            'body_type' => 'required|string',
            'engine_no' => 'required|string',
            'owners_name' => 'required|string',
            'registration_status' => 'required|string'
        ];
    }
}
