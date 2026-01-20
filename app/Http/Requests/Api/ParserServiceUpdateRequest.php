<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ParserServiceUpdateRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'max:255'],
            'base_url' => ['sometimes', 'string', 'max:2048'],
            'is_active' => ['sometimes', 'boolean'],
            'http_enabled' => ['sometimes', 'boolean'],
            'ymq_enabled' => ['sometimes', 'boolean'],
        ];
    }
}
