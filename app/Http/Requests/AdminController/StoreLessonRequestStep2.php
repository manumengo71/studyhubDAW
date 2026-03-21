<?php

namespace App\Http\Requests\AdminController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLessonRequestStep2 extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
        $rules = [
            'content_type' => 'required|string|exists:lessons_types,id',
        ];

        // Reglas condicionales para el campo 'media'
        if ($this->content_type == 2) {
            $rules['media'] = 'required|file|mimes:pdf|max:10485760';
        } elseif ($this->content_type == 3) {
            $rules['media'] = 'required|file|mimes:mp4,mp3|max:10485760';
        } elseif ($this->content_type == 4) {
            $rules['media'] = 'required|file|mimes:png,jpg,jpeg|max:10485760';
        } else {
            $rules['media'] = 'nullable'; // Si no coincide con ninguno, no es obligatorio
        }

        // Regla condicional para el campo 'content' si 'content_type' es 5
        if ($this->content_type == 5) {
            $rules['content'] = 'required|json';
        } else {
            $rules['content'] = 'nullable|json'; // Si no es 5, no es obligatorio pero debe ser JSON si está presente
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'content_type.required' => 'El tipo de contenido es obligatorio.',
            'content_type.string' => 'El tipo de contenido debe ser una cadena de texto.',
            'content_type.exists' => 'El tipo de contenido seleccionado no es válido.',
            'media.required' => 'El archivo es obligatorio.',
            'media.file' => 'El archivo debe ser un archivo.',
            'media.mimes' => 'El tipo de archivo subido no se corresponde con el tipo de contenido seleccionado.',
            'media.max' => 'El archivo no puede pesar más de 10MB.',
            'content.required' => 'El contenido es obligatorio.',
            'content.json' => 'El contenido debe ser un JSON válido.',
        ];
    }
}
