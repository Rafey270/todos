<?php
/**
 * Created by PhpStorm.
 * User: shamsul
 * Date: 2018-08-28
 * Time: 11:07
 */

namespace App\Traits;


use Carbon\Carbon;
use http\Env\Request;

trait ApiHelper
{
    public function success($code, $data, $message = false, $extra = false)
    {
	    $result = [
		    'success' => true,
		    'message' => $message,
		    'data' => $data,
	    ];
        if($extra){
		    foreach ($extra as $key => $value){
			    $result[$key] = $value;
		    }
        }
	    return response()->json($result, $code);
    }

    public function error($code, $data=false, $message = false, $extra = false)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $data
        ], $code);
    }
}
