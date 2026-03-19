<?php

namespace App\Http\Requests\LessonController;

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
            'title' => 'string|max:50',
            'subtitle' => 'string|max:100',
            'content' => 'file|mimes:mp4,mp3,pdf,txt,png,jpg,jpeg|max:10485760',
            'content_type' => 'string|exists:lessons_types,id',
        ];
    }
}
