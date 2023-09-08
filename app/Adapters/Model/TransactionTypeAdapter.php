<?php

declare(strict_types=1);

namespace App\Adapters\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionTypeAdapter extends ModelAdapter
{
    public function adapt(): Model
    {
        return $this->model;
    }
}
