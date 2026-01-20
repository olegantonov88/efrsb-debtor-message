<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EfrsbStoreMessageBodyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_id' => ['nullable', 'uuid'],
            'message_id' => ['required', 'integer', 'min:1'],
            'message_uuid' => ['required', 'string', 'max:100'],
            'message_number' => ['nullable', 'string', 'max:500'],
            'title' => ['required', 'string', 'max:500'],
            'body_html_base64' => ['required', 'string'],
            'meeting_application_id' => ['nullable', 'integer', 'min:1'],
        ];
    }
}


