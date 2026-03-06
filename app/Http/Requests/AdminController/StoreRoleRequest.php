<?php

namespace App\Http\Requests\AdminController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // IMPORTANTE: En visualStudioCode salta un error al acceder a hasRole, pero funciona correctamente. (Dejo mensaje por posibles errores a futuro).
        if (auth()->user()->hasRole('admin')) {
            return true;
        } else {
            return false;
        }
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
            'guard_name' => 'required|string|max:255',
        ];
    }
}
