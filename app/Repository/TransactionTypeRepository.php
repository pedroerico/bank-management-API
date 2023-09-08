<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\TransactionTypesEnum;
use App\Models\TransactionType;

class TransactionTypeRepository extends AbstractRepository implements TransactionTypeRepositoryInterface
{
    protected static $model = TransactionType::class;

    public function findByAcronym(TransactionTypesEnum $acronym): TransactionType|null
    {
        return self::loadModel()::where('acronym', $acronym->value)->first();
    }
}
