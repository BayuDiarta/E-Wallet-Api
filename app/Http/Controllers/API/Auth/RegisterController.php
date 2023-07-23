<?php

namespace App\Http\Controllers\API\Auth;

use App\Traits\Response;
use Illuminate\Http\Request;
use App\Services\RegisterService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    use Response;
    protected $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->middleware('auth:api', ['except' => ['register']]);
        $this->registerService = $registerService;
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:6|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->numbers()->symbols()->mixedCase()],
            'telphone' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'min:11'],
        ]);
        if($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 422);
        }

        $data = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'telphone' => $request->input('telphone'),
        ];

        $user = $this->registerService->register($data);

        return $this->successResponse($user, 'Successfully Registered', 200);
    }
}
