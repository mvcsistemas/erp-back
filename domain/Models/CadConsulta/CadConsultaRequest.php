<?php

namespace MVC\Models\CadConsulta;

use MVC\Base\MVCRequest;

class CadConsultaRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'          => '',
            'data_consulta' => 'required',
            'procedimento'  => 'required',
            'valor'         => 'required',
            'id_paciente'   => 'required',
            'id_podologo'   => 'required',
            'created_at'    => '',
            'updated_at'    => '',
        ];
    }

    public function messages()
    {
        return [
            'data_consulta.required' => 'O campo Data Consulta é obrigatório.',
            'procedimento.required'  => 'O campo Procedimento é obrigatório.',
            'valor.required'         => 'O campo Valor é obrigatório.',
            'id_paciente.required'   => 'O campo Paciente é obrigatório.',
            'id_podologo.required'   => 'O campo Podólogo é obrigatório.',
        ];
    }
}
