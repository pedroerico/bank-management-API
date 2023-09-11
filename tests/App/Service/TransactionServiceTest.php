<?php

namespace Tests\App\Service;

use App\DTO\Transactions\RequestTransactionDTO;
use App\Enums\TransactionTypesEnum;
use App\Http\Requests\CreateTransactionRequest;
use App\Models\Account;
use App\Models\Transactions;
use App\Services\TransactionService;
use Database\Factories\AccountFactory;
use Database\Factories\TransactionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    public function testCreateTransactionWithValidData()
    {
        $account = Account::factory()->create(['balance' => 1000.0]);

        $transactionService = app(TransactionService::class);

        $requestData = new CreateTransactionRequest([
            'forma_pagamento' => 'C',
            'conta_id' => $account->number,
            'valor' => 100.0,
        ]);

        $dto = RequestTransactionDTO::makeFromRequest($requestData);

        $transaction = $transactionService->create($dto);

        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'account_id' => $account->id,
            'transaction_type_id' => $transaction->transaction_type_id,
            'value' => 100.0,
        ]);

        $account = Account::find($account->id);
        $this->assertEquals(895.0, $account->balance);
    }

    public function testCreateTransactionWithNonExistingAccount()
    {
        $transactionService = app(TransactionService::class);

        $requestData = new CreateTransactionRequest([
            'forma_pagamento' => TransactionTypesEnum::CREDIT_CARD->value,
            'conta_id' => 9999,
            'valor' => 100.0,
        ]);

        $dto = RequestTransactionDTO::makeFromRequest($requestData);

        try {
            $transactionService->create($dto);
        } catch (\Exception $e) {
            $this->assertEquals('Conta não encontrada.', $e->getMessage());
        }
    }

    public function testCreateTransactionWithInsufficientBalance()
    {
        $account = AccountFactory::new()->create(['balance' => 50.0]);

        $transactionService = app(TransactionService::class);

        $requestData = new CreateTransactionRequest([
            'forma_pagamento' => TransactionTypesEnum::CREDIT_CARD->value,
            'conta_id' => $account->number,
            'valor' => 100.0,
        ]);

        $dto = RequestTransactionDTO::makeFromRequest($requestData);

        try {
            $transactionService->create($dto);
        } catch (\Exception $e) {
            $this->assertEquals('Saldo insuficiente.', $e->getMessage());
        }
    }
}
