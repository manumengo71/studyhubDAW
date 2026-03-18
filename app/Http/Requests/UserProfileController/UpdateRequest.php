<?php

namespace App\Http\Requests\UserProfileController;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'surname' => 'required|string|max:25',
            'second_surname' => 'required|string|max:25',
            'birthdate' => 'required|date',
            'biological_gender' => 'required|string|max:255',
        ];
    }
}
