<?php

namespace MVC\Models\Dre;

use MVC\Base\MVCRequest;

class DreRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'            => '',
            'competencia_dre' => 'required',
            'fechamento_dre'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'competencia_dre.required' => 'O campo Competência é obrigatório.',
            'fechamento_dre.required'  => 'O campo Fechamento é obrigatório.'
        ];
    }
}
