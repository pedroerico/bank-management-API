<?php

namespace Tests\App\Http\Requests;

use App\Http\Requests\CreateAccountRequest;
use Tests\TestCase;

class CreateAccountRequestTest extends TestCase
{
    public function testValidationRules()
    {
        $request = new CreateAccountRequest();

        $this->assertTrue($request->authorize());

        $this->assertEquals([
            'conta_id' => 'required|integer|unique:accounts,number',
            'saldo' => 'required|numeric|min:0',
        ], $request->rules());
    }
}
