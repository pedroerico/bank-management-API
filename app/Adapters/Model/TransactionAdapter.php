<?php

declare(strict_types=1);

namespace App\Adapters\Model;

use Illuminate\Database\Eloquent\Model;

class TransactionAdapter extends ModelAdapter
{
    public function adapt(): Model
    {
        $fillable = [
            'transaction_type_id',
            'account_id',
            'value',
            'fees',
        ];

        $this->model->fillable($fillable);
        return $this->model;
    }
}
