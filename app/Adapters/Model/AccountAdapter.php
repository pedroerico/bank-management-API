<?php

declare(strict_types=1);

namespace App\Adapters\Model;

use Illuminate\Database\Eloquent\Model;

class AccountAdapter extends ModelAdapter
{
    public function adapt(): Model
    {
        $fillable = [
            'number',
            'balance',
        ];

        $this->model->fillable($fillable);
        return $this->model;
    }
}
