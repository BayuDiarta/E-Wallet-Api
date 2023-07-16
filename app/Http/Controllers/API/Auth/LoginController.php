<?php

namespace App\Http\Controllers\API\Auth;
use App\Traits\Response;
use Illuminate\Http\Request;
use App\Services\LoginService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    use Response;
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 422);
        }

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $token = $this->loginService->attemptLogin($credentials);
        try {
            if (!$token) {
                return $this->errorResponse(null, 'Invalid credentials.', 401);
            }
        } catch (JWTException $e) {
            return $this->errorResponse(null, 'Could not create token.', 500);
        }

        return $this->successResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60 * 24
        ], 'successfully created token');
    }
}
