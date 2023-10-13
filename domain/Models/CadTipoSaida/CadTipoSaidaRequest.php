<?php

namespace MVC\Models\CadTipoSaida;

use MVC\Base\MVCRequest;

class CadTipoSaidaRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                   => '',
            'dsc_tipo_saida'         => 'required',
            'fk_id_grupo_financeiro' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dsc_tipo_saida.required'         => 'O campo Descrição é obrigatório.',
            'fk_id_grupo_financeiro.required' => 'O campo Grupo Financeiro é obrigatório.'
        ];
    }
}
