<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transactions;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transactions::class;

    public function definition(): array
    {
        $account = Account::first() ?: Account::factory()->create();
        $transactionType = TransactionType::first();

        return [
            'account_id' => $account->id,
            'transaction_type_id' => $transactionType->id,
            'value' => $this->faker->randomFloat(2, 0, 500),
            'fees' => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}
