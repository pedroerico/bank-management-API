<?php

declare(strict_types=1);

namespace App\DTO\Transactions;

use App\DTO\AbstractDTO;

class CreateTransactionDTO extends AbstractDTO
{
    public function __construct(
        public int $transactionTypeId,
        public string $accountId,
        public float $value,
        public float $fees
    ) {
    }
}
