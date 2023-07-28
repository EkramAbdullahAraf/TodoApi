<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Auth::user()->todos;
        return response()->json(['todos' => $todos], 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $todo = $user->todos()->create($request->all());
        return response()->json(['todo' => $todo], 201);
    }

    public function show($id)
    {
        $todo = Auth::user()->todos()->find($id);
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }
        return response()->json(['todo' => $todo], 200);
    }

    public function update(Request $request, $id)
    {
        $todo = Auth::user()->todos()->find($id);
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }
        $todo->update($request->all());
        return response()->json(['todo' => $todo], 200);
    }

    public function destroy($id)
    {
        $todo = Auth::user()->todos()->find($id);
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }
        $todo->delete();
        return response()->json(['message' => 'Todo deleted'], 200);
    }
}
