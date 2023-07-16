<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    public function test_empty_input()
    {
        $data = [
            'email' => '',
            'password' => '',
        ];

        $response = $this->json('POST', '/api/auth/login', $data);

        $response
            ->seeStatusCode(422)
            ->seeJsonStructure([
                'meta'
            ]);
    }

    public function test_invalid_input()
    {
        $data = [
            'email' => 'failed@gmail.com',
            'password' => 'failed',
        ];

        $response = $this->json('POST', '/api/auth/login', $data);

        $response->seeStatusCode(401)->seeJsonStructure(['meta']);
    }

    public function test_login_with_success()
    {
        $data = [
            'email' => 'email@gmail.com',
            'password' => 'password',
        ];
        
        $response = $this->json('POST', '/api/auth/login', $data);
        $response->seeStatusCode(200)->seeJsonStructure(['data']);
    }
}
