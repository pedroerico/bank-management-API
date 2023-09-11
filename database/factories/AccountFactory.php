<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Account::class;

    public function definition(): array
    {
        return [
            'number' => $this->faker->unique()->randomNumber(),
            'balance' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
