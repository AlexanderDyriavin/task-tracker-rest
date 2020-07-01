<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodosResource;
use App\Http\Resources\UsersResourse;
use App\Models\Todos;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todos = '';
        $sorted = '';
        $sort = $request->input('sort');
        switch ($sort) {
            case 'status':
                $todos = Todos::all()->sortByDesc('status');
                $sorted = 'by Status DESC';
                break;
            case 'users':
                $todos = User::with('todos')->get()->sortByDesc('created_at');
                $sorted = 'by User creation time';
                break;
            default:
                $sorted = 'by default';
                $todos = Todos::all();
                break;
        }
        return response(['status' => 'Successfully received',
            'sort_type' => $sorted,
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
     * @param \App\Models\Todos $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todos $todo)
    {
        return response(['message' => 'Success',
            'task' => new TodosResource($todo)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Todos $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todos $todo)
    {
        $todo->update($request->input());
        return response(['message' => 'successfully updated', 'todo' => new TodosResource($todo)], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Todos $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todos $todo)
    {
        $todo->delete();
        return response(['message' => 'Task was deleted'], 404);
    }

    public function updateStatus($id, Request $request)
    {
        $todo = Todos::findOrFail($id);
        $todo->updateStatus($id, $request->input('status'));
        return response(['message' => 'Status was updated',
            'task' => new TodosResource($todo)], 200);
    }

    public function updateUser($id, Request $request)
    {
        $todo = Todos::find($id);
        $todo->updateAssignedUser($id, $request->input('user_id'));

    }
}
