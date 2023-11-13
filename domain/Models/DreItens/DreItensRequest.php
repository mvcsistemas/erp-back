<?php

namespace MVC\Models\DreItens;

use MVC\Base\MVCRequest;

class DreItensRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'              => '',
            'aliquota'          => 'required',
            'valor_dre_item'    => 'required',
            'dsc_dre_item'      => 'required',
            'fk_uuid_grupo_dre' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'aliquota.required'          => 'O campo Alíquota é obrigatório.',
            'valor_dre_item.required'    => 'O campo Valor é obrigatório.',
            'dsc_dre_item.required'      => 'O campo Descrição é obrigatório.',
            'fk_uuid_grupo_dre.required' => 'O campo Grupo é obrigatório.'
        ];
    }
}
