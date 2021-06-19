<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\VerifiesEmails;

class AuthController extends Controller
{
    use VerifiesEmails;
    use ApiHelper;

    public function register(Request $request)
    {
        $validation = UserService::make()->validateNewUser($request);
        if($validation->fails())
        {
            return $this->error(422, $validation->errors(), $validation->messages()->first());
        }

        $user = UserService::make()->createUser($request);
        $user->sendApiEmailVerificationNotification();

        return $this->success(200, $user,'User Registered Successfully');

    }

    public function login(Request $request)
    {
        $validation = UserService::make()->validateUser($request);
        if($validation->fails())
        {
            return $this->error(422, $validation->errors(), $validation->messages()->first());
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(!Auth::attempt($credentials))
        {
            return $this->error(401, false, 'email / password is incorrect');
        }

        $user = User::where('email',$request->email)->first();

        if(is_null($user->email_verified_at))
        {
            $user->sendApiEmailVerificationNotification();
            return $this->error(401, false, 'Please Verify Your Email First');
        }

        if (auth()->attempt($credentials))
        {
            $tokenResult = auth()->user()->createToken('ApiUserAuthAccessToken');

            $data = [
                'accessToken' => $tokenResult->accessToken,
                'tokenType' => 'Bearer',
                'expiresAt' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                'user' => $user,
                'message' => 'login successfull'
            ];

            return $this->success(200,$data,'login successfull');
        }
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return $this->success(200, false, "Successfully logged out");
    }
}
