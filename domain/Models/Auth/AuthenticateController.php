<?php

namespace MVC\Models\Auth;

use MVC\Base\MVCController;
use MVC\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;

class AuthenticateController extends MVCController
{
    public function login(AuthenticateRequest $request): mixed
    {
        $credentials           = $request->only(['email', 'password']);
        $credentials['active'] = 1;
        $remember              = $request->remember;
        $user                  = User::where('email', $credentials['email'])->first();

        if ($user && Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return  auth()->user();
        }

        throw ValidationException::withMessages(['email' => Lang::get('login_senha_invalidos')]);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => Lang::get('desconectado_sucesso')]);
    }

    public function loginApi(AuthenticateRequest $request): mixed
    {
        $credentials = $request->only(['email', 'password']);
        $user        = User::where('email', $credentials['email'])->first();

        if ($user && $user->active && Hash::check($credentials['password'], $user->password)) {
            return $user->createToken('token-api')->plainTextToken;
        }

        throw ValidationException::withMessages(['email' => Lang::get('login_senha_invalidos')]);
    }

    public function logoutApi(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => Lang::get('desconectado_sucesso')]);
    }
}
