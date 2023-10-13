<?php

namespace MVC\Models\CadGrupoFinanceiro;

use MVC\Base\MVCRequest;

class CadGrupoFinanceiroRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                 => '',
            'dsc_grupo_financeiro' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dsc_grupo_financeiro.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
