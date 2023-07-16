<?php

namespace App\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\JwtRepository;
use App\Repositories\UserRepository;

class LoginService
{
    private $userRepository;
    private $jwtRepository;

    public function __construct(UserRepository $userRepository, JwtRepository $jwtRepository)
    {
        $this->userRepository = $userRepository;
        $this->jwtRepository = $jwtRepository;
    }

    public function attemptLogin(array $credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return false;
        }

        $token = $this->jwtRepository->createToken($credentials);
        return $token;

    }

}
