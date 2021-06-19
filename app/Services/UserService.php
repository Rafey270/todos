<?php
/**
 * Created by PhpStorm.
 * User: shahmdshamsulalam
 * Date: 23/10/2018
 * Time: 14.12
 */

namespace App\Services;
use App\Models\User;
use App\Traits\ApiHelper;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService extends Service {

    use ApiHelper;

    public function validateNewUser($request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        return $validation;
    }

    public function validateUser($request)
    {
        $validation = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        return $validation;
    }

    public function createUser($request)
    {
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $user;
    }

    public function verifyAndRedirect($response,$redirectPath,$api)
    {
        if($response->status() == 200)
        {
            $api_response = json_decode($response->body());
            if($api == 'loginUser')
            {
                Cookie::queue('bearerToken', $api_response->data->accessToken, 100);
            }
            else if($api == 'logoutUser')
            {
                Cookie::queue(Cookie::forget('bearerToken'));
            }
            toastr()->success($api_response->message);
            return redirect(url($redirectPath));
        }
        else
        {
            $api_response = json_decode($response->body());
            toastr()->error($api_response->message);
            return redirect()->back();
        }
    }
}
