<?php

namespace MVC\Models\CadConsulta;

use MVC\Base\MVCRequest;
use MVC\Rules\DateFimRule;

class CadConsultaHistoricoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'id_paciente' => 'required',
            'data_inicio' => 'required',
            'data_fim'    => ['required', new DateFimRule],
        ];
    }

    public function messages()
    {
        return [
            'id_paciente.required' => 'O campo Paciente é obrigatório.',
            'data_inicio.required' => 'O campo Data Início é obrigatório.',
            'data_fim.required'    => 'O campo Data Fim é obrigatório.',
        ];
    }
}
