<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $todos = Todo::all();

        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:40',
            'type' => 'required|in:todo,shopping',
        ]);

        $validated['user_id'] = 1;
        $validated['group_id'] = 1;

        $todo = Todo::create($validated);

        return response()->json([
            'message' => 'リストに追加されました!',
            'data' => $todo
        ], 201);

    }

    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo): JsonResponse //idではなくtodoにすると先回りしてくれる
    {
        $todo = Todo::findOrFail($todo);

        $validated = $request->validate([
            'title' => 'required|max:40',
            'type' => 'required|in:todo,shopping',
        ]);

        $todo->update($validated);

        return response()->json([
            'message' => 'リストを更新しました!',
            'data' => $todo
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): JsonResponse
    {
        $todo = Todo::findOrFail($todo);

        $todo->delete();

        return response()->json([
            'message' => 'リストから削除しました!',
        ]);
    }
}
