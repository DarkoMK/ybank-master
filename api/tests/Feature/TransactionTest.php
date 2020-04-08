<?php

namespace Tests\Feature;

use App\Account;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseMigrations;

    public function testTransaction($senderBalance = 0, $sendingAmount = 0, $expectedRemainingAmount = 0, $isWrong = false)
    {
        $sender = factory(Account::class)->create([
            'balance' => $senderBalance,
        ]);
        $receiver = factory(Account::class)->create([
            'balance' => 0,
        ]);
        $data = ['to' => $receiver->id, 'amount' => $sendingAmount, 'details' => 'test'];
        $expectedReturnData = ['balance' => $expectedRemainingAmount];
        if (!$isWrong) {
            return $this->post("/api/accounts/$sender->id/transactions", $data)->assertJson($expectedReturnData);
        }

        return $this->post("/api/accounts/$sender->id/transactions", $data)->assertStatus(403);
    }

    public function testValidInput()
    {
        return $this->testTransaction(10000, 9999, 1);
    }

    public function testOverspending()
    {
        return $this->testTransaction(5000, 10000, -5000, true);
    }
}
