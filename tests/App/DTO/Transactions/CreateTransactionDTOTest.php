<?php

declare(strict_types=1);

namespace Tests\App\DTO\Transactions;

use App\DTO\Transactions\CreateTransactionDTO;
use PHPUnit\Framework\TestCase;

class CreateTransactionDTOTest extends TestCase
{
    public function testMakeFromRequest()
    {
        $dto = new CreateTransactionDTO(1, '1', 100, 5);

        $this->assertSame(1, $dto->transactionTypeId);
        $this->assertSame('1', $dto->accountId);
        $this->assertSame(100.0, $dto->value);
        $this->assertSame(5.0, $dto->fees);
    }
}
