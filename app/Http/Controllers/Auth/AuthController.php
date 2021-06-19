<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\v1BaseController;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Traits\ApiHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;

class AuthController extends v1BaseController
{
    use ApiHelper;
    public $successStatus = 200;


    public function register()
    {
        return view('admin.auth.register');
    }

    public function registerUser(Request $request)
    {
        $response = Http::post($this->api_url.'register',$request->all());

        return UserService::make()->verifyAndRedirect($response,'login','');
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function loginUser(Request $request)
    {
        $response = Http::post($this->api_url.'login',$request->all());

        return UserService::make()->verifyAndRedirect($response,'home','loginUser');
    }

    public function logoutUser(Request $request)
    {
        $response = Http::withToken(Cookie::get('bearerToken'),'Bearer')
            ->post($this->api_url.'logout');

        return UserService::make()->verifyAndRedirect($response,'login','logoutUser');
    }
}
