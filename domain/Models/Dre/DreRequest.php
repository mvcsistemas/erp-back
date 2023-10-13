<?php

namespace MVC\Models\Dre;

use MVC\Base\MVCRequest;

class DreRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'           => '',
            'data_dre'       => 'required',
            'fechamento_dre' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'data_dre.required'       => 'O campo Data é obrigatório.',
            'fechamento_dre.required' => 'O campo Fechamento é obrigatório.'
        ];
    }
}
