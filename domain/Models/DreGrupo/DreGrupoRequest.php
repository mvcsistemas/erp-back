<?php

namespace MVC\Models\DreGrupo;

use MVC\Base\MVCRequest;

class DreGrupoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'          => '',
            'dsc_gre_grupo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'dsc_gre_grupo.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
