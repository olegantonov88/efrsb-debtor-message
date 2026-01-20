<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TaskStatusIndexRequest extends FormRequest
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
            'page' => ['sometimes', 'integer', 'min:1'],
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],

            'debtor_id' => ['sometimes', 'integer', 'min:1'],
            'job_id' => ['sometimes', 'string', 'max:64'], // public_id parse_jobs (uuid) или внешний job_id
            'type' => ['sometimes', 'string', 'max:64'], // ParseJobType value
            'latest_status' => ['sometimes', 'string', 'max:64'], // StatusParseJob value/int

            'task_type' => ['sometimes', 'string', 'max:64'], // process|find_uuid|message_tables
            'task_status' => ['sometimes', 'string', 'max:64'], // created|processing|success|error|...
        ];
    }
}
