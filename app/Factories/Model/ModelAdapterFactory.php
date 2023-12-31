<?php

declare(strict_types=1);

namespace App\Factories\Model;

use App\Adapters\Model\AccountAdapter;
use App\Adapters\Model\ModelAdapterInterface;
use App\Adapters\Model\TransactionAdapter;
use App\Adapters\Model\TransactionTypeAdapter;
use App\Exceptions\AdapterNotFoundException;
use App\Models\Account;
use App\Models\Transactions;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Model;

class ModelAdapterFactory implements ModelAdapterFactoryInterface
{
    protected array $adapterMapping = [
        Account::class => AccountAdapter::class,
        Transactions::class => TransactionAdapter::class,
        TransactionType::class => TransactionTypeAdapter::class,
    ];

    /**
     * @throws \Exception
     */
    public function createAdapter(Model $model): ModelAdapterInterface
    {
        $modelClass = get_class($model);

        if (isset($this->adapterMapping[$modelClass])) {
            $adapterClass = $this->adapterMapping[$modelClass];
            return new $adapterClass($model);
        }

        throw new AdapterNotFoundException('Adapter não encontrado para o modelo.');
    }
}
