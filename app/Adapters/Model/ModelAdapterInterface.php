<?php

declare(strict_types=1);

namespace App\Adapters\Model;

use Illuminate\Database\Eloquent\Model;

interface ModelAdapterInterface
{
    public function adapt(): Model;
}
