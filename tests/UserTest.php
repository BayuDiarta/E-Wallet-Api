<?php
namespace Tests;

use Tests\TestCase;
use App\Models\User;
Use App\Models\Wallet;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * Test case for creating a user.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $login = $this->login();
        $requestData = [
            'fullname' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'Pasww123!34',
            'password_confirmation' => 'Pasww123!34',
            'telphone' => '081234567890',
        ];

        $response = $this->post('/api/users', $requestData, ['Authorization' => 'Bearer ' . $login['token']]);

        $response->seeStatusCode(200)
            ->seeJsonStructure([
                'meta'
            ]);

        // Menambahkan asserstion tambahan sesuai dengan logika bisnis
        $this->seeInDatabase('users', [
            'email' => 'johndoe@example.com',
        ]);
    }

    /**
     * Test case for getting user profile.
     *
     * @return void
     */
     public function testGetUserProfile()
     {
         $login = $this->login();

         $this->get('/api/users/profile', ['Authorization' => 'Bearer ' . $login['token']])
             ->seeStatusCode(200)
             ->seeJsonStructure(['meta']);
     }

     /**
      * Test case for creating a wallet.
      *
      * @return void
      */
     public function testCreateWallet()
     {
         // Create a test user using the factory
         $user = User::factory()->create();

         // Create a wallet associated with the test user using the factory with state
         $wallet = Wallet::factory()->state([
             'user_id' => $user->id,
         ])->create();

         $login = $this->login();
         $requestData = $wallet->toArray();
         $this->post('/api/wallet/create',  $requestData, ['Authorization' => 'Bearer ' . $login['token']])
             ->seeStatusCode(200)
             ->seeJsonStructure(['meta']);
     }

     /**
      * Test case for updating a user.
      *
      * @return void
      */
     public function testUpdateUser()
     {
         $user = User::factory()->create();
         $login = $this->login();
         $requestData = [
             'fullname' => 'John Dos',
             'email' => 'johndoe@example.com',
             'password' => 'Pasww123!34',
             'password_confirmation' => 'Pasww123!34',
             'telphone' => '081234567890',
         ];

         $this->put('/api/users/' . $user->id, $requestData, ['Authorization' => 'Bearer ' . $login['token']])
             ->seeStatusCode(200)
             ->seeJsonStructure(['meta']);
     }

     /**
      * Test case for deleting a user.
      *
      * @return void
      */
     public function testDeleteUser()
     {
         $user = User::factory()->create();
         $login = $this->login();
         $this->delete('/api/users/' . $user->id, ['Authorization' => 'Bearer ' . $login['token']])
             ->seeStatusCode(200)
             ->seeJsonStructure(['meta']);
     }
}
