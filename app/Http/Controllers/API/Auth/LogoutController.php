<?php

namespace App\Http\Controllers\API\Auth;
use App\Traits\Response;
use App\Services\LogoutService;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class LogoutController extends Controller
{
    use Response;
    protected $logoutService;

    public function __construct(LogoutService $logoutService)
    {
        $this->logoutService = $logoutService;
    }

    public function logout() {
        try {
            $user = $this->logoutService->logout();
            return $this->successResponse($user, 'User has been logged out');
        } catch (JWTException $exception) {
            return $this->errorResponse(null, 'Sorry, user cannot be logged out', 500);
        }
    }
}
