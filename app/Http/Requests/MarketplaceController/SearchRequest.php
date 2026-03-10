<?php

namespace App\Http\Requests\MarketplaceController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
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
            'search' => 'nullable|string|max:255',
            'solocursos' => 'sometimes|accepted',
            'solocategorias' => 'sometimes|accepted',
            'nombre' => 'sometimes|accepted',
            'descripcion' => 'sometimes|accepted',
            'idioma' => Rule::when($this->idioma == '0', 'in:0', 'nullable|string'),
            'categoria' => Rule::when($this->categoria == '0', 'in:0', 'nullable|integer|exists:courses_categories,id'),
            'orden' => 'nullable|in:asc,desc',
        ];
    }
}
