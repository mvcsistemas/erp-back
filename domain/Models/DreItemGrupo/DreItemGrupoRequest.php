<?php

namespace MVC\Models\DreItemGrupo;

use MVC\Base\MVCRequest;

class DreItemGrupoRequest extends MVCRequest {

    public function rules()
    {
        return [
            'uuid'                 => '',
            'valor_dre_item_grupo' => 'required',
            'fk_uuid_grupo_dre'    => 'required',
            'fk_uuid_dre'          => 'required'
        ];
    }

    public function messages()
    {
        return [
            'valor_dre_item_grupo.required' => 'O campo Valor é obrigatório.',
            'fk_uuid_grupo_dre.required'    => 'O campo Grupo é obrigatório.',
            'fk_uuid_dre.required'          => 'O campo DRE é obrigatório.'
        ];
    }
}
