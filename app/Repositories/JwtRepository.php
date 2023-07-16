<?php

namespace App\Repositories;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtRepository
{
    public function createToken(array $user)
    {
        $token = JWTAuth::attempt($user);
        return $token;
    }

    public function invalidateToken()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
    }
}
