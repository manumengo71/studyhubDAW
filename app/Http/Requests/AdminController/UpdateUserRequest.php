<?php

namespace App\Http\Requests\AdminController;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->route('id'))], //Ignorar el email del usuario que se está editando para que no de conflicto el email ya que debe ser único.
            'name' => 'string|max:255',
            'surname' => 'string|max:255',
            'second_surname' => 'string|max:255',
            'birthdate' => 'nullable|date',
            'biological_gender' => 'nullable|string|max:255|in:Masculino,Femenino,Otro',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'role' => Rule::exists('roles', 'id')->where(function ($query) {
                $query->where('id', $this->input('role'));
            }),
        ];
    }
}
