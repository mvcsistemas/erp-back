<?php

namespace MVC\Models\CadGrupoDre;

use MVC\Base\MVCRequest;

class CadGrupoDreRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'          => '',
            'dsc_grupo_dre' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dsc_grupo_dre.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
