<?php

namespace App\Http\Middleware;

use App\Company;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthApiTokenOrApiKeyMiddleware
{

	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure $next
	 *
	 * @return mixed
	 * @throws \Exception
	 */

    public function handle($request, Closure $next)
    {
	    if ($request->is('api/*')) {
		    $bearertoken  = null;
	    	// does not works if places inside the exceptions
		    if($request->hasHeader('authorization')){
			    $bearertoken = $request->bearerToken();
		    }

	        try{

			    return app(\Illuminate\Auth\Middleware\Authenticate::class)->handle($request, function ($request) use ($next) {
				    return $next($request);
			    },'api');

		    }catch (\Exception $exception){
                if(!empty($bearertoken)){
                    $client = Company::where('live_key',$bearertoken)->first();
                    if(!empty($client)){
                        Auth::login($client->user);
                        return $next($request);
                    }
                }
			    throw $exception;
		    }
	    }
    }
}
