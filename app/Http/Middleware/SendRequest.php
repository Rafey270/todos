<?php

namespace App\Http\Middleware;
use App\Traits\ApiHelper;
use Closure;

use Illuminate\Support\Facades\Cookie;

class SendRequest
{
    use ApiHelper;
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(!Cookie::get('bearerToken'))
        {
            toastr()->error('Not Authorized');
            return redirect('login');
        }
        return $next($request);
    }
}
