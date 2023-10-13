<?php

namespace MVC\Models\DreItens;

use MVC\Base\MVCRequest;

class DreItensRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'            => '',
            'aliquota'        => 'required',
            'valor_dre_item'  => 'required',
            'dsc_dre_item'    => 'required',
            'fk_id_grupo_dre' => 'required',
            'fk_id_dre'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'aliquota.required'        => 'O campo Alíquota é obrigatório.',
            'valor_dre_item.required'  => 'O campo Valor é obrigatório.',
            'dsc_dre_item.required'    => 'O campo Descrição é obrigatório.',
            'fk_id_grupo_dre.required' => 'O campo Grupo é obrigatório.',
            'fk_id_dre.required'       => 'O campo DRE é obrigatório.'
        ];
    }
}
