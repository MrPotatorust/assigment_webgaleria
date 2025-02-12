<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        $isRegistered = filter_var($this->is_registered, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
        $this->merge(['is_registered' => $isRegistered]);

        return [
            'name' => 'required|string|max:255',
            'registration_number' => $this->is_registered ? 'required|integer|digits_between:1,10' : 'nullable|integer|digits_between:1,10',
            'is_registered' => 'required|boolean',
        ];
    }
}
