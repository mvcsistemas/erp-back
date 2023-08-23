<?php

namespace MVC\Models\CadConsulta\CadConsultaImagem;

use MVC\Base\MVCModel;

class CadConsultaImagem extends MVCModel {

    protected $table      = 'cad_consulta_imagem';
    protected $primaryKey = 'id_arquivo';
    protected $guarded    = [''];

    public function lists(array $params = [])
    {
        $rows = $this->select('cad_consulta_imagem.*')
                     ->join('cad_consulta', 'cad_consulta.id_consulta', 'cad_consulta_imagem.id_consulta');

        $rows = $this->filter($rows, $params);

        return $rows;
    }

    public function filter($query, array $params = [])
    {
        $id_arquivo      = (int)($params['id_arquivo'] ?? '');
        $uuid            = (string)($params['uuid'] ?? '');
        $nome_arquivo    = (string)($params['nome_arquivo'] ?? '');
        $observacao      = (string)($params['observacao'] ?? '');
        $tipo_ordenacao  = $params['tipo_ordenacao'] ?? '';
        $campo_ordenacao = $params['campo_ordenacao'] ?? '';

        if ($id_arquivo) {
            $query->where('cad_consulta_imagem.id_arquivo', $id_arquivo);
        }

        if ($uuid) {
            $query->where('cad_consulta.uuid', $uuid);
        }

        if ($nome_arquivo) {
            $query->where('nome_arquivo', 'LIKE', "%{$nome_arquivo}%");
        }

        if ($observacao) {
            $query->where('observacao', 'LIKE', "%{$observacao}%");
        }

        if ($tipo_ordenacao && $campo_ordenacao) {
            $query->orderBy($campo_ordenacao, $tipo_ordenacao);
        } else {
            $query->orderBy('id_arquivo', 'desc');
        }

        return $query;
    }
}
