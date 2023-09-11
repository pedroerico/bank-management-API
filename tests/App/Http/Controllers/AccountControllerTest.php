<?php

namespace Tests\App\Http\Controllers;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testConsultAccount()
    {
        $account = Account::factory()->create(['number' => 1]);

        $response = $this->get('/api/conta?id=' . $account->number);

        $response->assertStatus(200)->assertJson([
            'conta_id' => $account->number,
            'saldo' => floatval($account->balance),
        ]);
    }

    public function testStoreAccount()
    {
        $data = ['conta_id' => 2, 'saldo' => 200.0];

        $response = $this->post('/api/conta', $data);

        $response->assertStatus(201)->assertJson([
            'conta_id' => $data['conta_id'],
            'saldo' => $data['saldo'],
        ]);
    }
}
