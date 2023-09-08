<?php

declare(strict_types=1);

namespace App\Providers;

use App\Factories\Model\ModelAdapterFactory;
use App\Factories\Model\ModelAdapterFactoryInterface;
use App\Repository\AccountRepository;
use App\Repository\AccountRepositoryInterface;
use App\Repository\TransactionRepository;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\TransactionTypeRepository;
use App\Repository\TransactionTypeRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ModelAdapterFactoryInterface::class, ModelAdapterFactory::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(TransactionTypeRepositoryInterface::class, TransactionTypeRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
