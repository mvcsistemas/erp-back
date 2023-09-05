<?php

namespace MVC\Models\FirstAccess;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\SendOtpFirtAccess;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;
use MVC\Base\MVCController;
use MVC\Models\User\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;

class FirstAccessController extends MVCController {

    public function generate(Request $request): Response
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if ( ! $user) {
            throw ValidationException::withMessages([
                'email' => Lang::get('User')
            ]);
        } else if ( ! $user->ativo) {
            throw ValidationException::withMessages([
                'email' => [Lang::get('inactive_user')]
            ]);
        } else if ($user && $user->password) {
            throw ValidationException::withMessages([
                'email' => Lang::get('user_has_password')
            ]);
        }

        $verificationCode = $this->generateOtp($request->email);

        return $verificationCode;
    }

    public function generateOtp(User $user): mixed
    {

        $verificationCode = FirstAccess::where('user_uuid', $user->uuid)->latest('expire_at')->first();

        $now = Carbon::now();

        if ($verificationCode) {
            if ($now->isBefore($verificationCode->expire_at)) {
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

    public function checkCodeForNewPassword(Request $request): Response
    {
        $request->validate([
            'user_uuid' => 'required|exists:users,uuid',
            'otp'       => 'required'
        ]);

        $verificationCode = $this->validateCode($request);

        $user = User::whereUuid($request->user_uuid)->first();

        if ($user) {
            return response()->json($verificationCode);
        }

        throw ValidationException::withMessages([
            Lang::get('invalid_code')
        ]);
    }

    public function createPassword(Request $request): Response
    {
        $request->validate([
            'user_uuid' => 'required',
            'otp'       => 'required',
            'password'  => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        $verificationCode = $this->validateCode($request);

        $user = User::whereUuid($request->user_uuid)->first();

        if ($user) {
            $user->forceFill([
                'password' => Hash::make($request->password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);

            return response()->json([Lang::get('successfully_created_password')]);
        }

        throw ValidationException::withMessages([
            Lang::get('invalid_code')
        ]);
    }

    public function validateCode(Request $request): Response
    {
        $verificationCode = FirstAccess::where('user_uuid', $request->user_uuid)->where('otp', $request->otp)->first();

        $now = Carbon::now();

        if ( ! $verificationCode) {
            throw ValidationException::withMessages([
                Lang::get('invalid_code')
            ]);
        } elseif ($verificationCode && $now->isAfter($verificationCode->expire_at)) {
            throw ValidationException::withMessages([
                Lang::get('expired_code')
            ]);
        }

        return $verificationCode;
    }
}
