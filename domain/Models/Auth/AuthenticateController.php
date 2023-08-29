<?php

namespace MVC\Models\Auth;

use MVC\Base\MVCController;
use MVC\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends MVCController
{
    public function login(AuthenticateRequest $request): Response
    {
        $credentials           = $request->only(['email', 'password']);
        $credentials['active'] = 1;
        $remember              = $request->remember;
        $user                  = User::where('email', $credentials['email'])->first();

        dd($credentials);
        if ($user && $user->ativo && Auth::attempt($credentials, $remember)) {
            // $request->session()->regenerate();

            return  auth()->user();
        }

        throw ValidationException::withMessages(['email' => 'Email e/ou senha inválido(s).']);
    }

    public function logout(Request $request): Response
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Desconectado com sucesso.']);
    }

    public function loginApi(AuthenticateRequest $request): Response
    {
        $credentials = $request->only(['email', 'password']);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            return $user->createToken('token-api')->plainTextToken;
        }

        throw ValidationException::withMessages(['email' => 'Email e/ou senha inválido(s).']);
    }

    public function logoutApi(): Response
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Desconectado com sucesso.']);
    }
}
