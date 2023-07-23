<?php
namespace Tests;

use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Wallet;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class TransactionTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testGetTransactionDetails()
    {
        // Create a test user with a wallet using the factory
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user);

        $walletId = $wallet->id;

        $response = $this->json('GET', '/api/transaction/detail', [], ['Authorization' => 'Bearer ' . $user['token']]);
        $response->seeStatusCode(200)->seeJsonStructure(['meta', 'data']);
    }
}
