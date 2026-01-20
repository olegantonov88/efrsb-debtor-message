<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ParserServiceStateRequest extends FormRequest
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
            'service_id' => ['required', 'integer', 'min:1'],
            'state' => ['required', 'string', 'in:started,finished'],
            'job_id' => ['required', 'string', 'min:1', 'max:100'],
            'task_type' => ['required', 'string', 'in:process,find_uuid,message_tables'],
        ];
    }
}
