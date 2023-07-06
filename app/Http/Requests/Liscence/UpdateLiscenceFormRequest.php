<?php

namespace App\Http\Requests\Liscence;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLiscenceFormRequest extends FormRequest
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
            'identification_no' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'registration_date' => 'required|date',
            'liscence_class' => 'required|string',
            'expiration_date' => 'required|date'
        ];
    }
}
