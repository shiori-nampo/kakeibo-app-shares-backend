<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = Todo::shopping()->with('completedUser')
        ;

        if ($user->current_group_id) {
            $shoppingList = $query->where('group_id', $user->current_group_id)->get();
        } else {
            $shoppingList = $query->where('user_id', $user->id)->get();
        }

        return response()->json([
            'data' => $shoppingList
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate(['title' => 'required|max:40']);


        $validated['type'] = 'shopping';
        $validated['user_id'] = $request->user()->id;
        $validated['group_id'] = $request->user()->current_group_id;

        $shopping = Todo::create($validated);

        return response()->json([
            'message' => 'Shoppingリストに追加しました',
            'data' => $shopping->load('completedUser')
        ], 201);
    }

    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $shopping): JsonResponse
    {
        if ($shopping->type !== 'shopping') {
            return response()->json(['message' => 'データが見つかりません'], 404);
        }

        $isCompleted = $request->boolean('is_completed');
        $completedBy = $isCompleted ? Auth::id() : null;

        $shopping->update([
            'is_completed' => $isCompleted,
            'completed_by' => $completedBy,
        ]);

        return response()->json([
            'message' => '更新しました',
            'data' => $shopping->load('completedUser')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $shopping): JsonResponse
    {
        if ($shopping->type !== 'shopping') {
            return response()->json(['message' => 'データが見つかりません'], 404);
        }

        $shopping->delete();
        return response()->json(['message' => '削除しました']);
    }
}
