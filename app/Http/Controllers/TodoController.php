<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodosResource;
use App\Http\Resources\UsersResourse;
use App\Models\Todos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todos::all();
        return response(['status' => 'Successfully received',
            'todos' => $todos], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $validation = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        $todo = $user->todos()->create($validation->validated());
        return response(['message' => 'Success',
            'task' => new TodosResource($todo)]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Todos $todos
     * @return \Illuminate\Http\Response
     */
    public function show(Todos $todos)
    {
        return response(['message' => 'Success',
            'task' => new TodosResource($todos)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Todos $todos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todos $todo)
    {
        $todos = Todos::find($id);
        dd($todos);
        $todos->update($request->input());
        dd($todos->update(['title' => $request->title]));
        return response(['message'=> 'success','todos' => new UsersResourse($todos)],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todos $todos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todos $todos)
    {
        //
    }
}
