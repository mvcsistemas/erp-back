<?php

namespace MVC\Models\Dre;

use Illuminate\Validation\Rule;
use MVC\Base\MVCRequest;

class DreRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'            => '',
            'competencia_dre' => ['required', Rule::unique('dre')->where(function ($query) {
                return $query->where('uuid', '<>', request()->uuid);
            })],
            'fechamento_dre'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'competencia_dre.required' => 'O campo Competência é obrigatório.',
            'competencia_dre.unique'   => 'Está competência já existe',
            'fechamento_dre.required'  => 'O campo Fechamento é obrigatório.'
        ];
    }
}
