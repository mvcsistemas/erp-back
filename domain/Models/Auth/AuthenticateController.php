<?php

namespace MVC\Models\Auth;

use MVC\Base\MVCController;
use MVC\Models\User\User;
use MVC\Models\CadPodologo\CadPodologo;
use MVC\Models\CadFuncionario\CadFuncionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateController extends MVCController
{
    public function login(AuthenticateRequest $request)
    {
        $credentials   = $request->only(['email', 'password']);
        $remember      = $request->remember;
        $user          = User::where('email', $credentials['email'])->first();
        $tipo_cadastro = $user->tipoCadastro instanceof CadFuncionario ? 'F' : 'P';
        $nome          = $tipo_cadastro == 'F' ? $user->tipoCadastro->nome_funcionario : $user->tipoCadastro->nome_podologo;

        if ($user->tipoCadastro->ativo && $user->tipoCadastro->acesso_sistema && Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return  ['name' => $nome, 'tipo_cadastro' => $tipo_cadastro];
        }

        throw ValidationException::withMessages(['email' => ['Email e/ou senha inválido(s).']]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Desconectado com sucesso.']);
    }

    public function loginApi(AuthenticateRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email e/ou senha inválido(s).'],
            ]);
        }

        return $user->createToken('token-api')->plainTextToken;
    }

    public function logoutApi()
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Desconectado com sucesso.']);
    }
}
