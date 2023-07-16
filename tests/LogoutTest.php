<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_token_not_found()
    {
        $response = $this->json('POST','/api/logout');
        $response->seeStatusCode(401)->seeJsonStructure(['status']);
    }


    public function test_logout_with_success()
    {
        $user = $this->loginUser();
        $response = $this->post('/api/logout', [], ['Authorization' => 'Bearer ' . $user['token']]);
        $response->seeStatusCode(200)->seeJsonStructure(['meta']);
    }
}