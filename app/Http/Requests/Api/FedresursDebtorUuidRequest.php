<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FedresursDebtorUuidRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'debtor_id' => ['required', 'integer', 'min:1'],
            'user_id' => ['nullable', 'integer', 'min:1'],
            // callback from parser (when uuid найден)
            'debtor_uuid' => ['nullable', 'string', 'max:100'],
            'job_id' => ['nullable', 'uuid'],
        ];
    }
}


