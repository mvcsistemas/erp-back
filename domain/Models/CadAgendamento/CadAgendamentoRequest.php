<?php

namespace MVC\Models\CadAgendamento;

use MVC\Base\MVCRequest;
use MVC\Rules\TimeSizeRule;

class CadAgendamentoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'               => '',
            'agenda_ou_bloqueia' => 'required',
            'data_agendamento'   => 'required',
            'hora_inicio'        => 'required',
            'hora_fim'           => ['required', new TimeSizeRule()],
            'telefone'           => '',
            'celular'            => '',
            'observacao'         => '',
            'id_status'          => 'required',
            'id_paciente'        => 'required_if:agenda_ou_bloqueia,A',
            'id_podologo'        => 'required_if:agenda_ou_bloqueia,A',
            'created_at'         => '',
            'updated_at'         => '',
        ];
    }

    public function messages()
    {
        return [
            'agenda_ou_bloqueia.required' => 'O campo Agenda é obrigatório.',
            'data_agendamento.required'   => 'O campo Data é obrigatório.',
            'hora_inicio.required'        => 'O campo Início é obrigatório.',
            'hora_fim.required'           => 'O campo Fim é obrigatório.',
            'id_paciente.required_if'     => 'O campo Paciente é obrigatório.',
            'id_status.required'          => 'O campo Status é obrigatório.',
        ];
    }
}
