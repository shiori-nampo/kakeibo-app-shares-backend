<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoppingController;
use App\Models\User;


Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    $user = User::findOrFail($id);

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect('http://localhost:3001/transaction/list?verified=true');
})->name('verification.verify');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/email/verification-notification', function (Request $request) {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Already verified'], 200);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification-link-sent']);
    });


    Route::middleware(['verified'])->group(function () {

        Route::get('/transactions', [TransactionController::class, 'index']);
        Route::post('/transactions', [TransactionController::class, 'store']);
        Route::get('/transactions/{date}', [TransactionController::class, 'show']);
        Route::patch('/transactions/{id}', [TransactionController::class, 'update']);
        Route::delete('transactions/{id}', [TransactionController::class, 'destroy']);


        Route::apiResource('todo', TodoController::class);
        //↑これでindex,store,show,update.delete全部担う

        Route::apiResource('shopping', ShoppingController::class);

        Route::get('/categories', [CategoryController::class, 'index']);
    });

});