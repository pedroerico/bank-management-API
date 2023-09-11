<?php

declare(strict_types=1);

namespace Tests\App\DTO\Account;

use App\DTO\Accounts\CreateAccountDTO;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class CreateAccountDTOTest extends TestCase
{
    public function testMakeFromRequest()
    {
        $request = new Request(['conta_id' => 1, 'saldo' => 100.0]);

        $dto = CreateAccountDTO::makeFromRequest($request);

        $this->assertSame(1, $dto->number);
        $this->assertSame(100.0, $dto->balance);
    }
}
