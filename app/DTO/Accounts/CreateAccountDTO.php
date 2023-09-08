<?php

declare(strict_types=1);

namespace App\DTO\Accounts;

use App\DTO\AbstractDTO;
use Illuminate\Http\Request;

class CreateAccountDTO extends AbstractDTO
{
    public function __construct(
        public int $number,
        public float $balance,
    ) {
    }

    public static function makeFromRequest(Request $request): self
    {
        return new self(
            $request->conta_id,
            $request->saldo
        );
    }
}
