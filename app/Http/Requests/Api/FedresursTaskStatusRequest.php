<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FedresursTaskStatusRequest extends FormRequest
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
            'job_id' => ['required', 'uuid'],
            'task_type' => ['required', 'string', 'in:process,find_uuid,message_tables'],
            'ok' => ['required', 'boolean'],
            'start_ip' => ['nullable', 'ip'],
            'end_ip' => ['nullable', 'ip'],
            'error' => ['nullable', 'string'],
            'stats' => ['nullable', 'array'],
            'debtor_id' => ['required', 'integer', 'min:1'],
        ];
    }
}
