<?php

namespace MVC\Models\FluxoCaixaEntrada;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class FluxoCaixaEntrada extends MVCModel {

    use HasUuid;

    protected $table      = 'fluxo_caixa_entrada';
    protected $primaryKey = 'id_fluxo_caixa_entrada';
    protected $guarded    = ['id_fluxo_caixa_entrada'];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('cad_tipo_entrada.uuid as fk_uuid_tipo_entrada',
                             'cad_tipo_entrada.dsc_tipo_entrada as dsc_tipo_entrada',
                             'fluxo_caixa.uuid as fk_uuid_fluxo_caixa',
                             'cad_grupo_financeiro.uuid as fk_uuid_grupo_financeiro',
                             'cad_grupo_financeiro.dsc_grupo_financeiro as dsc_grupo_financeiro')
                    ->join('cad_tipo_entrada', 'cad_tipo_entrada.id_tipo_entrada', 'fluxo_caixa_entrada.fk_id_tipo_entrada')
                    ->join('fluxo_caixa', 'fluxo_caixa.id_fluxo_caixa', 'fluxo_caixa_entrada.fk_id_fluxo_caixa')
                    ->join('cad_grupo_financeiro', 'cad_grupo_financeiro.id_grupo_financeiro', 'fluxo_caixa_entrada.fk_id_grupo_financeiro');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid                = (string)($params['uuid'] ?? '');
        $fk_uuid_fluxo_caixa = (string)($params['fk_uuid_fluxo_caixa'] ?? '');
        $tipo_ordenacao      = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao     = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('fluxo_caixa_entrada.uuid', $uuid);
            })
            ->when($fk_uuid_fluxo_caixa, function ($query) use ($fk_uuid_fluxo_caixa) {
                $query->where('fluxo_caixa.fk_uuid_fluxo_caixa', $fk_uuid_fluxo_caixa);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('fluxo_caixa_entrada.data_fluxo_caixa_entrada');
            });
    }
}
