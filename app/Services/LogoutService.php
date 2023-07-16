<?php

namespace App\Services;

use App\Repositories\JwtRepository;
use App\Repositories\UserRepository;

class LogoutService
{
    private $userRepository;
    private $jwtRepository;

    public function __construct(UserRepository $userRepository, JwtRepository $jwtRepository)
    {
        $this->userRepository = $userRepository;
        $this->jwtRepository = $jwtRepository;
    }

    public function logout()
    {
        $this->jwtRepository->invalidateToken();
    }
}
