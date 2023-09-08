<?php

declare(strict_types=1);

namespace App\Adapters\Model;

use Illuminate\Database\Eloquent\Model;

abstract class ModelAdapter implements ModelAdapterInterface
{
    public function __construct(
        protected Model $model
    ) {
    }

    abstract public function adapt(): Model;
}
