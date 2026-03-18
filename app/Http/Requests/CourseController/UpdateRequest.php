<?php

namespace App\Http\Requests\CourseController;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:120',
            'short_description' => 'required|string|max:200',
            'description' => 'required|string',
            'language' => 'required|string|in:Español,Inglés,Francés,Alemán,Italiano,Portugués,Chino (Mandarín),Hindi,Árabe,Bengalí,Ruso,Japonés,Malayo,Telugu,Vietnamita,Coreano',
            'price' => 'required|numeric|min:0|max:999.99',
            'owner_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->where('id', $this->input('owner_id'))
                        ->where('id', auth()->id());
                }),
            ],
            'courses_categories_id' => 'required|exists:courses_categories,id',
            'imageCourse' => 'nullable|file|mimes:png,jpg,jpeg|max:1048',
        ];
    }
}
