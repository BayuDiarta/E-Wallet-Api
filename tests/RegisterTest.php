<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;
    public function test_empty_input()
    {
        $data = [
            'fullname' => '',
            'email' => '',
            'password' => '',
            'telphone' => '',
        ];

        $response = $this->json('POST', '/api/auth/register', $data);

        $response
            ->seeStatusCode(422)
            ->seeJsonStructure([
                'meta'
            ]);
    }

    public function test_invalid_input()
    {
        $data = [
            'fullname' => 'abay',
            'email' => 'abaya.com',
            'password' => '9dssdsds',
            'telphone' => 'ddsdsdsdsd',
        ];

        $response = $this->json('POST', '/api/auth/register', $data);
        $response->seeStatusCode(422)->seeJsonStructure(['meta']);
    }

    public function test_register_with_success()
    {
        $formData = [
            'fullname' => 'Testing',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),  
            'telphone' => '08936454545'
        ];
        
        $response = $this->json('POST', '/api/auth/register', $formData);
        $response->seeStatusCode(200)->seeJsonStructure(['meta']);
    }
}
 