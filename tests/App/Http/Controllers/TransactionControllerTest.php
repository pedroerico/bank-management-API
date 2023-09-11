<?php

namespace Tests\App\Http\Controllers;

use App\Enums\TransactionTypesEnum;
use Database\Factories\AccountFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    public function testCreateTransactionIntegrationUsingFactory()
    {
        $account = AccountFactory::new()->create(['balance' => 1000.0]);

        $requestData = [
            'forma_pagamento' => TransactionTypesEnum::CREDIT_CARD->value,
            'conta_id' => $account->number,
            'valor' => 100.0,
        ];

        $response = $this->json('POST', '/api/transacao', $requestData);

        $response->assertStatus(201)->assertJson([
            'conta_id' => $account->number,
            'saldo' => 895.0, // Assumindo que a transação deduziu corretamente o valor da conta.
        ]);

        $this->assertDatabaseHas('transactions', [
            'account_id' => $account->id,
            'value' => 100.0,
        ]);

        $this->assertDatabaseHas('accounts', [
            'id' => $account->id,
            'balance' => 895.0,
        ]);
    }

    public function testCreateTransactionWithInvalidData()
    {
        $account = AccountFactory::new()->create(['balance' => 1000.0]);

        $requestData = [
            'forma_pagamento' => 'InvalidPaymentMethod',
            'conta_id' => $account->number,
            'valor' => -100.0,
        ];

        $response = $this->json('POST', '/api/transacao', $requestData);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['forma_pagamento', 'valor']);
    }

    public function testCreateTransactionWithNonExistingAccount()
    {
        $requestData = [
            'forma_pagamento' => TransactionTypesEnum::CREDIT_CARD,
            'conta_id' => 9999,
            'valor' => 100.0,
        ];

        $response = $this->json('POST', '/api/transacao', $requestData);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['conta_id']);
    }

    public function testCreateTransactionWithInsufficientBalance()
    {
        $account = AccountFactory::new()->create(['balance' => 50.0]);

        $requestData = [
            'forma_pagamento' => TransactionTypesEnum::CREDIT_CARD,
            'conta_id' => $account->number,
            'valor' => 100.0,
        ];

        $response = $this->json('POST', '/api/transacao', $requestData);

        $response->assertStatus(Response::HTTP_NOT_FOUND)->assertJson(['error' => 'Saldo insuficiente.']);
    }
}
