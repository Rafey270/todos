<?php
/**
 * Created by PhpStorm.
 * User: shahmdshamsulalam
 * Date: 23/10/2018
 * Time: 14.12
 */

namespace App\Services;
use App\Models\Todos;
use App\Models\User;
use App\Traits\ApiHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TodoService extends Service {

    use ApiHelper;

    public function validateTodo($request)
    {
        $validation = Validator::make($request->all(),[
            'title' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        return $validation;
    }

    public function ifExists($request)
    {
        $ifExists = Todos::where('user_id',auth()->user()->id)
            ->where('title',$request->title)
            ->where('description',$request->description)
            ->first();
        if($ifExists)
        {
            return true;
        }
    }

    public function createTodo($request)
    {
        $userTodo = new Todos();
        $userTodo->user_id = auth()->user()->id;
        $userTodo->title = $request->title;
        $userTodo->description = $request->description;

        $userTodo->save();

        return $userTodo;
    }
    public function updateTodo($userTodo,$request)
    {
        $userTodo->title = $request->title;
        $userTodo->description = $request->description;
        $userTodo->save();
    }

    public function verifyAndRedirect($response,$redirectPath)
    {
        if($response->status() == 200)
        {
            $api_response = json_decode($response->body());
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
