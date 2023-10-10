<?php

namespace MVC\Models\ResetPassword;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password as RulesPassword;
use MVC\Models\User\User;

class ResetPasswordController extends Controller {

    public function forgotPassword(Request $request): mixed
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ( ! $user || ! $user->active ) {
            throw ValidationException::withMessages([
                'email' => [Lang::get('usuario_invalido')]
            ]);
        } else if ($user && ! $user->password) {
            throw ValidationException::withMessages([
                'email' => Lang::get('nao_foi_possivel_prosseguir')
            ]);
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return [
                'status' => __($status),
            ];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)]
        ]);
    }

    public function resetPassword(Request $request): mixed
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => ['required', RulesPassword::defaults(), 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
                'message' => Lang::get('senha_alterada_sucesso')
            ]);
        }

        return response([
            'message' => __($status)
        ], 500);
    }
}
