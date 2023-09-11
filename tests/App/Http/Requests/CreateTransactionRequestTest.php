<?php

namespace Tests\App\Http\Requests;

use App\Enums\TransactionTypesEnum;
use App\Http\Requests\CreateTransactionRequest;
use Illuminate\Validation\Rules\Enum;
use Tests\TestCase;

class CreateTransactionRequestTest extends TestCase
{
    public function testValidationRules()
    {
        $request = new CreateTransactionRequest();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'forma_pagamento' => ['required', new Enum(TransactionTypesEnum::class)],
            'conta_id' => 'required|integer|exists:accounts,number',
            'valor' => 'required|numeric|min:0',
        ], $request->rules());
    }
}
