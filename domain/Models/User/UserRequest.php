<?php

namespace MVC\Models\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest {

    public function rules()
    {
        return [
            'id'                => '',
            'uuid'              => '',
            'email'             => ['required', Rule::unique('users')->ignore(request()->id)],
            'password'          => '',
            'active'            => 'required',
            'remember_token'    => '',
            'email_verified_at' => '',
            'created_at'        => '',
            'updated_at'        => ''
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'O campo E-mail é obrigatório.',
            'password.required' => 'O campo Senha é obrigatório.',
            'active.required'   => 'O campo Ativo é obrigatório.'
        ];
    }
}
