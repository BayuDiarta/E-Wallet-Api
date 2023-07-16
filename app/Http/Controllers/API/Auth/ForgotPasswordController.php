<?php

namespace App\Http\Controllers\API\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use Response;

    public function forgotPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => "required|email|unique:password_resets,email"
        ]);

        if ($validator->fails()) {
            return $this->errorResponse(null, $validator->errors(), 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return $this->errorResponse(null, 'Email not found', 404);
        }

        $data = [
            'email' => $user->email,
            'token' => Str::random(64),
            'created_at' => Carbon::now(),
        ];
    
        DB::table('password_resets')->updateOrInsert(['email' => $user->email], $data);
      
        $user->notify(new PasswordReset($user));

        return $this->successResponse($data['token'], 'Link reset password send successfully');
    }

}