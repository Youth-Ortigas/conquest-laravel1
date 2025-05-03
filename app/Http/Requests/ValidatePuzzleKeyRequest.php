<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePuzzleKeyRequest extends FormRequest
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
            'puzzle_key' => 'required',
            'puzzle_num' => 'required|numeric|in:1,2.1,2.2,2.3,3'
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
            'puzzle_key.required' => 'The puzzle key is required.',

            'puzzle_num.required' => 'The puzzle number is required.',
            'puzzle_num.numeric' => 'The puzzle number must be numeric.',
            'puzzle_num.in' => 'The puzzle number must be 1, 2.1, 2.2, 2.3, or 3.',
        ];
    }
}
