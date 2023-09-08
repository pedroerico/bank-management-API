<?php

declare(strict_types=1);

namespace App\Repository;

use App\Enums\TransactionTypesEnum;
use App\Models\TransactionType;

interface TransactionTypeRepositoryInterface
{
    public function findByAcronym(TransactionTypesEnum $acronym): TransactionType|null;
}
