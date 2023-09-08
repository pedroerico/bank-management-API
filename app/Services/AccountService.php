<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use App\Repository\AccountRepositoryInterface;

class AccountService
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository
    ) {
    }

    /**
     * @throws \Exception
     */
    public function consult(int $id): Account
    {
        $account = $this->accountRepository->findByNumber($id);
        if (!$account) {
            throw new \Exception('Conta não encontrada.');
        }

        return $account;
    }
}
