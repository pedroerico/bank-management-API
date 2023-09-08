<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\TransactionTypesEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypeSeeder extends Seeder
{
    public function run(): void
    {
        foreach (TransactionTypesEnum::cases() as $value) {
            DB::table('transaction_types')->insert([
                'name' => TransactionTypesEnum::getNameFromAcronym($value),
                'acronym' => $value,
                'rate' => TransactionTypesEnum::getRateFromAcronym($value),
            ]);
        }
    }
}
