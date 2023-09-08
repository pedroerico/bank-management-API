<?php

declare(strict_types=1);

namespace App\Providers;

use App\Factories\Model\ModelAdapterFactory;
use App\Factories\Model\ModelAdapterFactoryInterface;
use App\Repository\AccountRepository;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind(ModelAdapterFactoryInterface::class, ModelAdapterFactory::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
    }
}
