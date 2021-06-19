<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class TodosController extends v1BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.todos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::withToken(Cookie::get('bearerToken'),'Bearer')->post($this->api_url.'todos',$request->all());

        return TodoService::make()->verifyAndRedirect($response,'todos');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::withToken(Cookie::get('bearerToken'),'Bearer')->get($this->api_url.'todos',$id);
        $todo = json_decode($response->body())->data;

        return view('admin.todos.edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = Http::withToken(Cookie::get('bearerToken'),'Bearer')->patch($this->api_url.'todos/'.$id,$request->all());

        return TodoService::make()->verifyAndRedirect($response,'todos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::withToken(Cookie::get('bearerToken'),'Bearer')->delete($this->api_url.'todos/'.$id);

        return TodoService::make()->verifyAndRedirect($response,'todos');
    }

}
