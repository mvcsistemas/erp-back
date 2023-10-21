<?php

namespace MVC\Models\CadTipoEntrada;

use MVC\Base\MVCRequest;

class CadTipoEntradaRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'             => '',
            'dsc_tipo_entrada' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dsc_tipo_entrada.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
