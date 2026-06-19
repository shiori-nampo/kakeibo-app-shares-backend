<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Todo;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $shoppingList = Todo::shopping()->where('user_id', $request->user()->id)->get();

        return response()->json($shoppingList);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate(['title' => 'required|max:40']);

        $shopping = Todo::create([
            'title' => $validated['title'],
            'type' => 'shopping',
            'user_id' => $request->user()->id,
            'group_id' => $request->user()->current_group_id,
        ]);

        return response()->json(['message' => 'Shoppingリストに追加しました', 'data' => $shopping], 201);
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

        $shopping->update(['is_completed' => $request->is_completed]);
        return response()->json(['message' => '更新しました']);
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
