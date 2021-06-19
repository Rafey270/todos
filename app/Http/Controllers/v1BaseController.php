<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class v1BaseController extends Controller
{
    protected $api;

    public function __construct()
    {
        $this->api_url = URL::to('/').'/api/';

        $this->middleware(function ($request, $next)
        {
            if(session()->has('auth'))
            {
                $this->api->setToken(session('auth')['accessToken']);
            }
            return $next($request);
        });
    }

    public function setCookie(Request $request){
        $minutes = 60;
        $response = new Response('Bearer Token');
        $response->withCookie(cookie('Bearer Token', 'MyValue', $minutes));
        return $response;
    }

}
