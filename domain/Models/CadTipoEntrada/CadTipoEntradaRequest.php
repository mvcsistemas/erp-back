<?php

namespace MVC\Models\CadTipoEntrada;

use MVC\Base\MVCRequest;

class CadTipoEntradaRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                   => '',
            'dsc_tipo_entrada'       => 'required',
            'fk_id_grupo_financeiro' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dsc_tipo_entrada.required'       => 'O campo Descrição é obrigatório.',
            'fk_id_grupo_financeiro.required' => 'O campo Grupo Financeiro é obrigatório.'
        ];
    }
}
