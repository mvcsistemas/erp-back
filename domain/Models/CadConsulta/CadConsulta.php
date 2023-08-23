<?php

namespace MVC\Models\CadConsulta;

use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadConsulta extends MVCModel {

    use HasUuid;

    protected $table      = 'cad_consulta';
    protected $primaryKey = 'id_consulta';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(){
        return $this->select('cad_consulta.*',
                             'cad_paciente.id_paciente',
                             'cad_paciente.nome_paciente',
                             'cad_paciente.uuid as uuid_paciente',
                             'cad_podologo.id_podologo',
                             'cad_podologo.nome_podologo')
                    ->join('cad_paciente', 'cad_paciente.id_paciente', 'cad_consulta.id_paciente')
                    ->join('cad_podologo', 'cad_podologo.id_podologo', 'cad_consulta.id_podologo');
    }

    public function filter($query, array $params = [])
    {
        $id              = (int)($params['id_consulta'] ?? '');
        $id_paciente     = (int)($params['id_paciente'] ?? '');
        $id_podologo     = (int)($params['id_podologo'] ?? '');
        $uuid            = (string)($params['uuid'] ?? '');
        $data_consulta   = setData($params['data_consulta'] ?? '');
        $data_inicio     = setData($params['data_inicio'] ?? '');
        $data_fim        = setData($params['data_fim'] ?? '');
        $tipo_ordenacao  = $params['tipo_ordenacao'] ?? '';
        $campo_ordenacao = $params['campo_ordenacao'] ?? '';

        if ($id) {
            $query->where('id_consulta', $id);
        }

        if ($uuid) {
            $query->where('cad_consulta.uuid', $uuid);
        }

        if ($id_paciente) {
            $query->where('cad_paciente.id_paciente', $id_paciente);
        }

        if ($id_podologo) {
            $query->where('cad_podologo.id_podologo', $id_podologo);
        }

        if ($data_consulta) {
            $query->where('data_consulta', $data_consulta);
        }

        if ($data_inicio && $data_fim) {
            $query->whereBetween('data_consulta', [$data_inicio, $data_fim]);
        }

        if ($tipo_ordenacao && $campo_ordenacao) {
            $query->orderBy($campo_ordenacao, $tipo_ordenacao);
        } else {
            $query->orderBy('data_consulta', 'desc');
        }

        return $query;
    }
}
