<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EfrsbStoreMessagesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_id' => ['nullable', 'uuid'],
            'debtor_id' => ['required', 'integer', 'min:1'],
            'messages' => ['required', 'array'],
            'messages.*.publish_date' => ['nullable', 'string'],
            'messages.*.message_uuid' => ['required', 'string', 'max:100'],
            'messages.*.message_name' => ['required', 'string', 'max:500'],
            'messages.*.arbitrator_uuid' => ['nullable', 'string', 'max:100'],
            'messages.*.arbitrator_name' => ['nullable', 'string', 'max:500'],
            'messages.*.sro_uuid' => ['nullable', 'string', 'max:100'],
            'messages.*.sro_name' => ['nullable', 'string', 'max:1000'],
        ];
    }
}


