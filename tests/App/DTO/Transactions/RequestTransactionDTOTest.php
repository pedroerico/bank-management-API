<?php

declare(strict_types=1);

namespace Tests\App\DTO\Transactions;

use App\DTO\Transactions\RequestTransactionDTO;
use App\Enums\TransactionTypesEnum;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTransactionDTOTest extends TestCase
{
    public function testMakeFromRequest()
    {
        $request = new Request(['forma_pagamento' => 'C', 'conta_id' => 123456, 'valor' => 100]);

        $dto = RequestTransactionDTO::makeFromRequest($request);

        $this->assertSame(TransactionTypesEnum::CREDIT_CARD, $dto->paymentForm);
        $this->assertSame(123456, $dto->number);
        $this->assertSame(100.0, $dto->value);
    }
}
