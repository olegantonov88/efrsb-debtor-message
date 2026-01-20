<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FedresursDebtorMessagesTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'integer', 'min:1'],
            'debtor_id' => ['required', 'integer', 'min:1'],
            'proxy' => ['nullable', 'array'],
            'proxy.use_proxy' => ['nullable', 'boolean'],
            'proxy.url' => ['nullable', 'string'],
        ];
    }
}


