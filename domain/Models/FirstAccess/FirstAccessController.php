<?php

namespace MVC\Models\FirstAccess;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\SendOtpFirtAccess;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use MVC\Base\MVCController;
use MVC\Models\User\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;

class FirstAccessController extends MVCController
{
    public function generate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $verificationCode = $this->generateOtp($request->email);

        return $verificationCode;
    }

    public function generateOtp($email)
    {
        $user = User::where('email', $email)->first();

        if(!$user){
            throw ValidationException::withMessages([
                'email' => Lang::get('User')
                ]);
        }else if(!$user->tipoCadastro->ativo || !$user->tipoCadastro->acesso_sistema){
            throw ValidationException::withMessages([
                'email' => [Lang::get('usuario_inativo_ou_sem_acesso')]
            ]);
        } else if($user && $user->password){
            throw ValidationException::withMessages([
                'email' => Lang::get('usuario_ja_cadastrado')
                ]);
        }

        $verificationCode = FirstAccess::where('user_uuid', $user->uuid)->latest('expire_at')->first();

        $now = Carbon::now();

        if($verificationCode){
            if($now->isBefore($verificationCode->expire_at)){
                $user->notify(new SendOtpFirtAccess($user, $verificationCode));

                return $verificationCode;
            }

            $verificationCode->delete();
        }

        $newCode = FirstAccess::create([
            'user_uuid' => $user->uuid,
            'otp'       => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);

        $user->notify(new SendOtpFirtAccess($user, $newCode));

        return $newCode;
    }

    public function checkCodeForNewPassword(Request $request)
    {
        $request->validate([
            'user_uuid' => 'required|exists:users,uuid',
            'otp' => 'required'
        ]);

        $verificationCode = $this->validateCode($request);

        $user = User::whereUuid($request->user_uuid)->first();

        if($user){
            return response()->json($verificationCode);
        }

        throw ValidationException::withMessages([
            Lang::get('codigo_invalido')
        ]);
    }

    public function createPassword(Request $request)
    {
        $request->validate([
            'user_uuid' => 'required',
            'otp'       => 'required',
            'password'  => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $verificationCode = $this->validateCode($request);

        $user = User::whereUuid($request->user_uuid)->first();

        if($user){
            $user->forceFill([
                'password' => Hash::make($request->password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);

            return response()->json([Lang::get('senha_criada_sucesso')]);
        }

        throw ValidationException::withMessages([
            Lang::get('codigo_invalido')
        ]);
    }


    public function validateCode(Request $request){
        $verificationCode = FirstAccess::where('user_uuid', $request->user_uuid)->where('otp', $request->otp)->first();

        $now = Carbon::now();

        if (!$verificationCode) {
            throw ValidationException::withMessages([
                Lang::get('codigo_invalido')
            ]);
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            throw ValidationException::withMessages([
                Lang::get('codigo_expirado')
            ]);
        }

        return $verificationCode;
    }
}
