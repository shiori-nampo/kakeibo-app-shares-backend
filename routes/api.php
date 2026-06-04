<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TodoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/transactions', [TransactionController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/{date}', [TransactionController::class, 'show']);
Route::patch('/transactions/{id}', [TransactionController::class, 'update']);
Route::delete('transactions/{id}', [TransactionController::class, 'destroy']);

Route::get('/todos', [TodoController::class, 'index']);
