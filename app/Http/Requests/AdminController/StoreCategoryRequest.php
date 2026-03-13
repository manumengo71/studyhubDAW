<?php

namespace App\Http\Requests\AdminController;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // IMPORTANTE: En visualStudioCode salta un error al acceder a hasRole, pero funciona correctamente. (Dejo mensaje por posibles errores a futuro).
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'imageCategory' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ];
    }
}
