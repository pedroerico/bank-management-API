<?php

declare(strict_types=1);

namespace Tests\App\Service;

use App\Exceptions\AccountException;
use App\Models\Account;
use App\Repository\AccountRepositoryInterface;
use App\Services\AccountService;
use PHPUnit\Framework\TestCase;

class AccountServiceTest extends TestCase
{
    public function testConsultAccountFound()
    {
        $accountId = 1;
        $mockAccount = new Account();

        $accountRepository = $this->createMock(AccountRepositoryInterface::class);
        $accountRepository
            ->expects($this->once())
            ->method('findByNumber')
            ->with($accountId)
            ->willReturn($mockAccount);

        $accountService = new AccountService($accountRepository);

        $result = $accountService->consult($accountId);

        $this->assertSame($mockAccount, $result);
    }

    public function testConsultAccountNotFound()
    {
        $accountId = 1;

        $accountRepository = $this->createMock(AccountRepositoryInterface::class);
        $accountRepository
            ->expects($this->once())
            ->method('findByNumber')
            ->with($accountId)
            ->willReturn(null);

        $accountService = new AccountService($accountRepository);

        $this->expectException(AccountException::class);
        $this->expectExceptionMessage('Conta não encontrada.');

        $accountService->consult($accountId);
    }
}
