<?php

namespace App\Http\Requests\BillingInformationController;

use Illuminate\Foundation\Http\FormRequest;

class StoreCardRequest extends FormRequest
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
            'second-surname' => 'required|string|max:25',
            'input-number-card' => 'required|numeric|digits:16',
            'input-expire-date-card' => 'required|date_format:m/y',
            'input-cvv-card' => 'required|numeric|digits:3',
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
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 25 caracteres.',
            'surname.required' => 'El apellido es obligatorio.',
            'surname.string' => 'El apellido debe ser una cadena de texto.',
            'surname.max' => 'El apellido no puede tener más de 25 caracteres.',
            'second-surname.required' => 'El segundo apellido es obligatorio.',
            'second-surname.string' => 'El segundo apellido debe ser una cadena de texto.',
            'second-surname.max' => 'El segundo apellido no puede tener más de 25 caracteres.',
            'input-number-card.required' => 'El número de la tarjeta es obligatorio.',
            'input-number-card.numeric' => 'El número de la tarjeta debe ser un número.',
            'input-number-card.digits' => 'El número de la tarjeta debe tener 16 dígitos.',
            'input-expire-date-card.required' => 'La fecha de vencimiento es obligatoria.',
            'input-expire-date-card.date_format' => 'La fecha de vencimiento debe tener el formato MM/AA.',
            'input-cvv-card.required' => 'El CVV es obligatorio.',
            'input-cvv-card.numeric' => 'El CVV debe ser un número.',
            'input-cvv-card.digits' => 'El CVV debe tener 3 dígitos.',
        ];
    }
}
