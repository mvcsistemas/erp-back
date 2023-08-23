<?php

namespace MVC\Models\CadAgendamento;

use Illuminate\Http\Resources\Json\JsonResource;

class CadAgendamentoResourceCalendar extends JsonResource {

    public function toArray($request)
    {
        $class = '';

        if($this->agenda_ou_bloqueia != 'A'){
            $class = 'bloqueado_vuecal';
        }else if($this->id_status == 0){
            $class = 'agendado_vuecal';
        }else if($this->id_status == 1){
            $class = 'confirmado_vuecal';
        }else if($this->id_status == 2){
            $class = 'nao_confirmado_vuecal';
        }

        $retorno = [
            'uuid'  => $this->uuid,
            'start' => $this->data_agendamento . ' ' . $this->hora_inicio,
            'end'   => $this->data_agendamento . ' ' . $this->hora_fim,
            'title' => $this->agenda_ou_bloqueia == 'A' ? $this->nome_paciente : 'BLOQUEADO',
            'class' => $class,
        ];

        return $retorno;
    }
}
