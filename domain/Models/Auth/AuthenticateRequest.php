<?php

namespace MVC\Models\Auth;

use MVC\Base\MVCRequest;

class AuthenticateRequest extends MVCRequest {

    public function rules()
    {
        return [
            'email'    => ['required', 'email'],
            'password' => 'required',
            'remember' => '',
        ];
    }

    public function messages()
    {
        return [
            'email.email'       => 'O campo E-mail está em um formato inválido.',
            'email.required'    => 'O campo E-mail é obrigatório.',
            'password.required' => 'O campo Senha é obrigatório.',
            'remember.required' => 'O campo Lembrar-me é obrigatório.',
        ];
    }
}
