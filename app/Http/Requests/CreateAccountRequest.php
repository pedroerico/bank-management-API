<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'conta_id' => 'required|integer|unique:accounts,number',
            'saldo' => 'required|numeric|min:0',
        ];
    }
}
