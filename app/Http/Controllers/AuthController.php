<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();
        //formRequestにルール書いたらこっちは消して$validatedへ

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        event(new Registered($user));


        Auth::login($user);


        return response()->json([
            'message' => 'ユーザーが登録されました!',
            'data' => $user
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();
        //ルール消して過去形に

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'メールアドレスまたはパスワードが間違っています。',
            ], 401);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'ログインに成功しました!',
            'data' => Auth::user()
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'ログアウトしました',
        ]);
    }
}
