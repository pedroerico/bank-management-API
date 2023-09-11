<?php

declare(strict_types=1);

namespace Tests\App\Repository;

use App\Adapters\Model\AccountAdapter;
use App\DTO\Accounts\CreateAccountDTO;
use App\Exceptions\AdapterNotFoundException;
use App\Factories\Model\ModelAdapterFactory;
use App\Models\Account;
use App\Repository\AccountRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class AccountRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testFindByNumber()
    {
        $account = Account::factory()->create(['number' => 123456]);

        $modelAdapterFactoryMock = Mockery::mock(ModelAdapterFactory::class);
        $accountAdapterMock = Mockery::mock(AccountAdapter::class);

        $modelAdapterFactoryMock->shouldReceive('createAdapter')->once()->andReturn($accountAdapterMock);

        $accountAdapterMock->shouldReceive('adapt')->once()->andReturn($account);

        $accountRepository = new AccountRepository($modelAdapterFactoryMock);

        $foundAccount = $accountRepository->findByNumber(123456);

        $this->assertInstanceOf(Account::class, $foundAccount);
        $this->assertEquals(123456, $foundAccount->number);
        $this->assertIsFloat($foundAccount->balance);
    }

    public function testFindByNumberWithException()
    {
        $modelAdapterFactoryMock = Mockery::mock(ModelAdapterFactory::class);
        $modelAdapterFactoryMock->shouldReceive('createAdapter')
            ->once()
            ->andThrow(new AdapterNotFoundException('Adapter não encontrado'));

        $accountRepository = new AccountRepository($modelAdapterFactoryMock);

        try {
            $accountRepository->findByNumber(123456);
            $this->fail('A exceção esperada não foi lançada');
        } catch (AdapterNotFoundException $exception) {
            $this->assertInstanceOf(AdapterNotFoundException::class, $exception);
            $this->assertEquals('Adapter não encontrado', $exception->getMessage());
        }
    }

    public function testCreateAccount()
    {
        $modelAdapterFactoryMock = Mockery::mock(ModelAdapterFactory::class);

        $modelAdapterFactoryMock
            ->shouldReceive('createAdapter')
            ->once()
            ->andThrow(AdapterNotFoundException::class, 'Adapter não encontrado');

        $accountRepository = new AccountRepository($modelAdapterFactoryMock);

        $mockCreateAccountDTO = Mockery::mock(CreateAccountDTO::class);

        $this->expectException(AdapterNotFoundException::class);
        $this->expectExceptionMessage('Adapter não encontrado');

        $accountRepository->create($mockCreateAccountDTO);
    }
}
