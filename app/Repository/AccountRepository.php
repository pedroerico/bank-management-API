<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Account;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface
{
    protected static $model = Account::class;

    public function findByNumber(int $number): Account|null
    {
        return self::loadModel()::where('number', $number)->first();
    }
}
