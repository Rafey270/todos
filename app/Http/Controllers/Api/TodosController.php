<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todos;
use App\Services\TodoService;
use App\Traits\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TodosController extends Controller
{
    use ApiHelper;
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userTodos = Todos::where('user_id',auth()->user()->id);

        $userTodos = DataTables::eloquent($userTodos);
        return $userTodos->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = TodoService::make()->validateTodo($request);
        if($validation->fails())
        {
            return $this->error(422, $validation->errors(), $validation->messages()->first());
        }

        $ifExists = TodoService::make()->ifExists($request);
        if($ifExists)
        {
            return $this->error(422, null, 'You Already Added This Todo');
        }

        TodoService::make()->createTodo($request);

        return $this->success(200, null, 'User Todo Saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userTodo = Todos::where('id',$id)->first();
        if($userTodo)
        {
            return $this->success(200, $userTodo, 'Todo Details');
        }
        else
        {
            return $this->error(404, null, 'No Todo Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = TodoService::make()->validateTodo($request);
        if($validation->fails())
        {
            return $this->error(422, $validation->errors(), $validation->messages()->first());
        }

        $userTodo = Todos::find($id)->first();
        if($userTodo)
        {
            TodoService::make()->updateTodo($userTodo,$request);
            return $this->success(200, null, 'User Todo Updated Successfully');
        }
        else
        {
            return $this->error(404, null, 'User Todo Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todos::find($id)->delete();
        return $this->success(200, null, 'User Todo Deleted Successfully');
    }
}
