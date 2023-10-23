<?php

namespace MVC\Models\CadTipoSaida;

use MVC\Base\MVCRequest;

class CadTipoSaidaRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'           => '',
            'dsc_tipo_saida' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dsc_tipo_saida.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
