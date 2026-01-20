<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FedresursMessageTablesTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'integer', 'min:1'],
            'messages' => ['required', 'array', 'min:1'],
            'messages.*.message_id' => ['required', 'integer', 'min:1'],
            'messages.*.message_uuid' => ['required', 'string', 'max:100'],
            'proxy' => ['nullable', 'array'],
            'proxy.use_proxy' => ['nullable', 'boolean'],
            'proxy.url' => ['nullable', 'string'],
            'meeting_application_id' => ['nullable', 'integer', 'min:1'],
            'callback_url' => ['nullable', 'string', 'url'],
        ];
    }
}


