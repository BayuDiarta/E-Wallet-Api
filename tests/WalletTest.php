<?php
namespace Tests;

use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Wallet;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class WalletTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testGetWalletDetail()
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->json('GET', '/api/wallet/detail');
        $response->assertResponseStatus(200);
        $response->seeJsonStructure(['meta', 'data' => ['balance']]);
    }

    public function testTopUpWallet()
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $requestData = [
            'amount' => 50000,
        ];

        $response = $this->json('POST', '/api/wallet/topup', $requestData);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure(['meta', 'data' => ['balance']]);
    }

    public function testTransferBalance()
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);


        $receiver = User::factory()->create();
        $receiverWallet = Wallet::factory()->create(['user_id' => $receiver->id]);

        // Add sufficient balance to the sender's wallet for testing
        $initialBalance = 20000;
        $wallet->balance = $initialBalance;
        $wallet->save();
        $requestData = [
            'amount' => 10000,
            'wallet_id' => $receiverWallet->id,
        ];

        $response = $this->json('POST', '/api/wallet/transfer', $requestData);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure(['meta', 'data' => ['balance']]);
    }

    public function testWithdrawBalance()
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        // Add sufficient balance to the wallet for testing
        $initialBalance = 30000;
        $wallet->balance = $initialBalance;
        $wallet->save();

        $requestData = [
            'amount' => 20000,
        ];

        $response = $this->json('POST', '/api/wallet/withdraw', $requestData);
        $response->assertResponseStatus(200);
        $response->seeJsonStructure(['meta', 'data' => ['balance']]);
    }
}
