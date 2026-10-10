<?php

namespace App\Http\Requests\Api;

use App\Enums\ParseJob\ParseJobType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DebtorLatestTaskDebtorMessagesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'debtor_id' => ['required', 'integer', 'min:1'],
            // Без типа - последняя задача любого типа, как раньше
            'type' => ['nullable', Rule::enum(ParseJobType::class)],
        ];
    }
}


