<?php

namespace App\Services;

use App\Repositories\UserRepository;

class RegisterService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $users)
    {
        try {
            return $this->userRepository->registerUser($users);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}