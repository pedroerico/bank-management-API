<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\AbstractInterfaceDTO;
use App\Models\Transactions;

class TransactionRepository extends AbstractRepository implements TransactionRepositoryInterface
{
    protected static $model = Transactions::class;

    public static function create(AbstractInterfaceDTO $dto): Transactions|null
    {
        return parent::create($dto);
    }
}
