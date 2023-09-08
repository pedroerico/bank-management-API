<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TransactionTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'forma_pagamento' => ['required', new Enum(TransactionTypesEnum::class)],
            'conta_id' => 'required|integer|exists:accounts,number',
            'valor' => 'required|numeric|min:0',
        ];
    }
}
