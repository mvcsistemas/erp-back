<?php

namespace MVC\Models\DreItens;

use MVC\Base\MVCRequest;
use MVC\Rules\DreItensRule;

class DreItensRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'              => '',
            'aliquota'          => 'required',
            'valor_dre_item'    => 'required',
            'tipo_item_uuid'    => ['required', new DreItensRule()],
            'tipo_item_model'   => 'required',
            'fk_uuid_grupo_dre' => 'required',
            'fk_uuid_dre'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'aliquota.required'          => 'O campo Alíquota é obrigatório.',
            'valor_dre_item.required'    => 'O campo Valor é obrigatório.',
            'tipo_item_uuid.required'    => 'O campo Tipo Item é obrigatório.',
            'tipo_item_model.required'   => 'O campo Model é obrigatório.',
            'fk_uuid_grupo_dre.required' => 'O campo Grupo é obrigatório.',
            'fk_uuid_dre.required'       => 'O campo DRE é obrigatório.'
        ];
    }
}
