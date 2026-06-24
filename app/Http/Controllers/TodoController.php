<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->current_group_id) {
            $todoList = Todo::todo()
                ->where('group_id', $user->current_group_id)
                ->with('completedUser')
                ->get();
        } else {
            $todoList = Todo::todo()
                ->where('user_id', $user->id)
                ->with('completedUser')
                ->get();
        }

        return response()->json($todoList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|max:40',
        ]);

        $validated['type'] = 'todo';
        $validated['user_id'] = $request->user()->id;
        $validated['group_id'] = $request->user()->current_group_id;


        $todo = Todo::create($validated);

        return response()->json([
            'message' => 'リストに追加されました!',
            'data' => $todo->load('completedUser')
        ], 201);

    }

    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo): JsonResponse
    {
        if ($todo->type !== 'todo') {
            return response()->json(['message' => 'データが見つかりません'], 404);
        }

        $completedBy = $request->is_completed ? Auth::id() : null;

        $todo->update([
            'is_completed' => $request->is_completed,
            'completed_by' => $completedBy,
        ]);

        return response()->json([
            'message' => 'リストを更新しました!',
            'data' => $todo->load('completedUser')
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): JsonResponse
    {
        if ($todo->type !== 'todo') {
            return response()->json(['message' => 'データが見つかりません'], 404);
        }

        $todo->delete();

        return response()->json([
            'message' => 'リストから削除しました!',
        ]);
    }
}
