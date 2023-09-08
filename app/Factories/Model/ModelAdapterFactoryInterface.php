<?php

declare(strict_types=1);

namespace App\Factories\Model;

use App\Adapters\Model\ModelAdapterInterface;
use Illuminate\Database\Eloquent\Model;

interface ModelAdapterFactoryInterface
{
    public function createAdapter(Model $model): ModelAdapterInterface;
}
