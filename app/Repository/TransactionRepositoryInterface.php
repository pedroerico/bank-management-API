<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\Transactions\CreateTransactionDTO;
use App\Models\Transactions;

interface TransactionRepositoryInterface
{
    public static function create(CreateTransactionDTO $dto): Transactions|null;
}
