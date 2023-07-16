<?php
namespace Tests;

use Tests\TestCase;
use App\Models\User;
use App\Models\Wallet;
use App\Http\Controllers\UserController;

class UserControllerTest extends TestCase
{

    /**
     * Test case for creating a user.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $login = $this->loginUser();
        $requestData = [
            'fullname' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'telphone' => '081234567890',
        ];

        $tes = $this->post('/api/users', $requestData, ['Authorization' => 'Bearer ' . $login['token']])
            ->seeStatusCode(200)
            ->seeJsonStructure(['meta']);
            
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
    // public function testGetUserProfile()
    // {
    //     $login = $this->loginUser();
    //     $user = User::factory()->create();

    //     $this->actingAs($user)
    //         ->get('/api/users/profile', ['Authorization' => 'Bearer ' . $login['token']])
    //         ->seeStatusCode(200)
    //         ->seeJsonStructure(['meta']);
    // }

//     /**
//      * Test case for creating a wallet.
//      *
//      * @return void
//      */
//     public function testCreateWallet()
//     {
//         $wallet = Wallet::factory()->create();
//         $login = $this->loginUser();
//         $this->actingAs($wallet)
//             ->post('/api/wallet/register',  $wallet, ['Authorization' => 'Bearer ' . $login['token']])
//             ->seeStatusCode(200)
//             ->seeJsonStructure(['meta']);
//     }

//     /**
//      * Test case for updating a user.
//      *
//      * @return void
//      */
//     public function testUpdateUser()
//     {
//         $user = User::factory()->create();
//         $login = $this->loginUser();
//         $requestData = [
//             'fullname' => 'Jane Doe',
//             'email' => 'janedoe@example.com',
//             'password' => 'newpassword',
//             'password_confirmation' => 'newpassword',
//             'telphone' => '081234567890',
//         ];

//         $this->actingAs($user)
//             ->put('/api/users/' . $user->id, $requestData, ['Authorization' => 'Bearer ' . $login['token']])
//             ->seeStatusCode(200)
//             ->seeJsonStructure(['meta']);

//         // Menambahkan asserstion tambahan sesuai dengan logika bisnis
//         $this->seeInDatabase('users', [
//             'id' => $user->id,
//             'fullname' => 'Jane Doe',
//             'email' => 'janedoe@example.com',
//         ]);
//     }

//     /**
//      * Test case for deleting a user.
//      *
//      * @return void
//      */
//     public function testDeleteUser()
//     {
//         $user = User::factory()->create();
//         $login = $this->loginUser();
//         $this->actingAs($user)
//             ->delete('/api/users/' . $user->id, ['Authorization' => 'Bearer ' . $login['token']])
//             ->seeStatusCode(200)
//             ->seeJsonStructure(['meta']);

//         // Menambahkan asserstion tambahan sesuai dengan logika bisnis
//         $this->notSeeInDatabase('users', [
//             'id' => $user->id,
//         ]);
//     }
}
