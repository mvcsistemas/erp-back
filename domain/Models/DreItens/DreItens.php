<?php

namespace MVC\Models\DreItens;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class DreItens extends MVCModel {

    use HasUuid;

    protected $table      = 'dre_itens';
    protected $primaryKey = 'id_dre_item';
    protected $guarded    = ['id_dre_item'];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('dre_itens.uuid', 'dre_itens.aliquota', 'dre_itens.valor_dre_item', 'dre_itens.tipo_item_model',
            'cad_grupo_dre.uuid as fk_uuid_grupo_dre', 'cad_grupo_dre.dsc_grupo_dre', 'dre.uuid as fk_uuid_dre',
            DB::raw("CASE
                            WHEN tipo_item_model = 'CadTipoEntrada' THEN cad_tipo_entrada.uuid
                            WHEN tipo_item_model = 'CadTipoSaida' THEN cad_tipo_saida.uuid
                          END AS tipo_item_uuid"),
            DB::raw("CASE
                            WHEN tipo_item_model = 'CadTipoEntrada' THEN cad_tipo_entrada.dsc_tipo_entrada
                            WHEN tipo_item_model = 'CadTipoSaida' THEN cad_tipo_saida.dsc_tipo_saida
                          END AS dsc_tipo_item"))
                    ->join('dre', 'dre.id_dre', 'dre_itens.fk_id_dre')
                    ->join('cad_grupo_dre', 'cad_grupo_dre.id_grupo_dre', 'dre_itens.fk_id_grupo_dre')
                    ->leftJoin('cad_tipo_entrada', function (JoinClause $join) {
                        $join->on('cad_tipo_entrada.id_tipo_entrada', '=', 'dre_itens.tipo_item_id')
                             ->where('dre_itens.tipo_item_model', 'CadTipoEntrada');
                    })
                    ->leftJoin('cad_tipo_saida', function (JoinClause $join) {
                        $join->on('cad_tipo_saida.id_tipo_saida', '=', 'dre_itens.tipo_item_id')
                             ->where('dre_itens.tipo_item_model', 'CadTipoSaida');
                    });
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $fk_uuid_dre     = (string)($params['fk_uuid_dre'] ?? '');
        $dsc_tipo_item   = (string)($params['dsc_tipo_item'] ?? '');
        $dsc_grupo_dre   = (string)($params['dsc_grupo_dre'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('dre_itens.uuid', $uuid);
            })
            ->when($fk_uuid_dre, function ($query) use ($fk_uuid_dre) {
                $query->where('dre.uuid', $fk_uuid_dre);
            })
            ->when($dsc_tipo_item, function ($query) use ($dsc_tipo_item) {
                $query->where('cad_tipo_entrada.dsc_tipo_entrada', 'like', "%$dsc_tipo_item%")
                      ->orWhere('cad_tipo_saida.dsc_tipo_saida', 'like', "%$dsc_tipo_item%");
            })
            ->when($dsc_grupo_dre, function ($query) use ($dsc_grupo_dre) {
                $query->where('dsc_grupo_dre', 'like', "%$dsc_grupo_dre%");
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('dre_itens.id_dre_item');
            });
    }
}
