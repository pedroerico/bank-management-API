<?php

declare(strict_types=1);

namespace App\Repository;

use App\DTO\Accounts\CreateAccountDTO;
use App\Models\Account;

interface AccountRepositoryInterface
{
    public function findByNumber(int $number): Account|null;

    public static function create(CreateAccountDTO $dto): Account;
}
