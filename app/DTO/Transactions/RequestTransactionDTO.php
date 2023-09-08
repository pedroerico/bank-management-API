<?php

declare(strict_types=1);

namespace App\DTO\Transactions;

use App\DTO\AbstractDTO;
use App\Enums\TransactionTypesEnum;
use Illuminate\Http\Request;

class RequestTransactionDTO extends AbstractDTO
{
    public function __construct(
        public TransactionTypesEnum $paymentForm,
        public int $number,
        public float $value,
    ) {
    }

    public static function makeFromRequest(Request $request): self
    {
        return new self(
            TransactionTypesEnum::tryFrom($request->forma_pagamento),
            $request->conta_id,
            $request->valor
        );
    }
}
