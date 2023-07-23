<?php
namespace Tests;

use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Wallet;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test case for register.
     *
     * @return void
     */
    public function testRegister()
    {
        $request = [
            'fullname' => 'Testing',
            'email' => 'test@example.com',
            'password' => 'password!23Pas',
            'password_confirmation' => 'password!23Pas',
            'telphone' => '08936454545'
        ];

        $response = $this->json('POST', '/api/auth/register', $request);
        $response->seeStatusCode(200)->seeJsonStructure(['meta']);
    }
    /**
     * Test case for login.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = User::factory(1)->create()->first();
        $data = [
            'email' => $user->email,
            'password' => 'Pasww123!34',
        ];

        $response = $this->json('POST', '/api/auth/login', $data);
        $response->seeStatusCode(200)->seeJsonStructure(['meta']);
    }

    /**
     * Test case for logout.
     *
     * @return void
     */
    public function testLogout()
    {
        $user = $this->login();
        $response = $this->post('/api/logout', [], ['Authorization' => 'Bearer ' . $user['token']]);
        $response->seeStatusCode(200)->seeJsonStructure(['meta']);
    }
}
