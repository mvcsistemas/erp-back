<?php

namespace MVC\Models\CadAgendamento;

use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadAgendamento extends MVCModel {

    use HasUuid;

    protected $table      = 'cad_agendamento';
    protected $primaryKey = 'id_agendamento';
    protected $guarded    = [''];
    public    $timestamps = true;

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id_status = 0;
        });
    }

    public function index(){
        return $this->select('cad_agendamento.*', 'cad_paciente.nome_paciente', 'cad_podologo.nome_podologo')
                    ->leftJoin('cad_podologo', 'cad_podologo.id_podologo', 'cad_agendamento.id_podologo')
                    ->leftJoin('cad_paciente', 'cad_paciente.id_paciente', 'cad_agendamento.id_paciente');
    }

    public function filter($query, array $params = [])
    {
        $id              = (int)($params['id_agendamento'] ?? '');
        $uuid            = (string)($params['uuid'] ?? '');
        $id_paciente     = (int)($params['id_paciente'] ?? '');
        $start_date      = (string)($params['start_date'] ?? '');
        $end_date        = (string)($params['end_date'] ?? '');
        $tipo_ordenacao  = $params['tipo_ordenacao'] ?? '';
        $campo_ordenacao = $params['campo_ordenacao'] ?? '';

        if ($id) {
            $query->where('cad_agendamento.id_agendamento', $id);
        }

        if ($uuid) {
            $query->where('cad_agendamento.uuid', $uuid);
        }

        if ($id_paciente) {
            $query->where('cad_agendamento.id_paciente', $id_paciente);
        }

        if($start_date && $end_date){
            $query->whereBetween('cad_agendamento.data_agendamento', [$start_date, $end_date]);
        }


        if ($tipo_ordenacao && $campo_ordenacao) {
            $query->orderBy($campo_ordenacao, $tipo_ordenacao);
        } else {
            $query->orderBy('cad_agendamento.data_agendamento')
                  ->orderBy('cad_agendamento.hora_inicio');
        }

        return $query;
    }

    public function getDscStatusAttribute()
    {
        return match ($this->id_status) {
                    0 => 'Agendado',
                    1 => 'Confirmado',
                    2 => 'Não Confirmado',
                };
    }
}
