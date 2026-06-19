<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $transactions = Transaction::all();

        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
            'memo' => 'nullable|string|max:30',
            'amount' => 'required|integer|min:1',
            'category_id' => 'required|integer',
        ]);

        //ログイン実装前の仮でシーダーを入れる
        $validated['user_id'] = 1;
        $validated['group_id'] = 1;

        $transaction = Transaction::create($validated);
        //バリデーションで通った適正なデータを$transactionに入れてDBへ保存している

        return response()->json([
            'message' => '保存が完了しました!',
            'data' => $transaction //一覧に表示する用で2回通信求めてくるから1回でいいようにdataに入れて渡してる
        ], 201);
        //201=データが作られた成功サイン

    }

    /**
     * Display the specified resource.
     */
    public function show(string $date): JsonResponse
    {
        $transactions = Transaction::where('date', $date)->get();//dateはDBのdate列がってこと（列の場所）,$dateにはフロントから来た日付が入ってる

        return response()->json($transactions);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
            'memo' => 'nullable|string|max:30',
            'amount' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ]);

        $filtered = array_filter($validated, function ($value) {
            return $value !== null;
        });

        $transaction->update($filtered);

        return response()->json([
            'message' => '修正が完了しました!',
            'data' => $transaction
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();//中身は消すのだから空でOK

        return response()->json([
            'message' => '削除しました!',
        ]);
    }
}
