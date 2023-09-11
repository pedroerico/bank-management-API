<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Transactions\CreateTransactionDTO;
use App\DTO\Transactions\RequestTransactionDTO;
use App\Enums\TransactionTypesEnum;
use App\Exceptions\ObjectiveNotFoundException;
use App\Helpers\Utils;
use App\Models\Account;
use App\Models\Transactions;
use App\Repository\AccountRepositoryInterface;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\TransactionTypeRepositoryInterface;

class TransactionService
{
    public function __construct(
        protected AccountRepositoryInterface $accountRepository,
        protected TransactionRepositoryInterface $transactionRepository,
        protected TransactionTypeRepositoryInterface $transactionTypeRepository,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function create(RequestTransactionDTO $dto): Transactions
    {
        $fees = Utils::getCalculateInterest($dto->value, TransactionTypesEnum::getRateFromAcronym($dto->paymentForm));
        $account = $this->accountRepository->findByNumber($dto->number);
        if (!$account) {
            throw new ObjectiveNotFoundException('Conta não encontrada.');
        }
        $newBalance = $this->getNewBalance($account, ($dto->value + $fees));

        $transactionType = $this->transactionTypeRepository->findByAcronym($dto->paymentForm);
        if (!$transactionType) {
            throw new ObjectiveNotFoundException('Tipo de transação não encontrado.');
        }

        $transaction = $this->transactionRepository->create(
            new CreateTransactionDTO($transactionType->id, $account->id, $dto->value, $fees)
        );

        try {
            $this->accountRepository->update($account->id, ['balance' => $newBalance]);
        } catch (\Exception) {
            $this->transactionRepository->delete($transaction->id);
            throw new ObjectiveNotFoundException('Erro ao debitar valor da conta. Transação revertida.');
        }

        return $transaction;
    }

    /**
     * @throws \Exception
     */
    public function getNewBalance(Account $account, float $value): float
    {
        $newBalance = ($account->balance - $value);
        if ($newBalance < 0) {
            throw new ObjectiveNotFoundException('Saldo insuficiente.');
        }

        return $newBalance;
    }
}
