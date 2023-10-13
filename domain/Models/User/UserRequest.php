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
            'name'              => 'required',
            'email'             => ['required', Rule::unique('users')->where(function ($query) {
                return $query->where('uuid', '<>', request()->uuid);
            })],
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
            'name.required'   => 'O campo Nome é obrigatório.',
            'email.required'  => 'O campo E-mail é obrigatório.',
            'active.required' => 'O campo Ativo é obrigatório.'
        ];
    }
}
