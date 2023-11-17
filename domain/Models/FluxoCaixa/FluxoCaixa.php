<?php

namespace MVC\Models\FluxoCaixa;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class FluxoCaixa extends MVCModel {

    use HasUuid;

    protected $table      = 'fluxo_caixa';
    protected $primaryKey = 'id_fluxo_caixa';
    protected $guarded    = ['id_fluxo_caixa'];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid                    = (string)($params['uuid'] ?? '');
        $competencia_fluxo_caixa = (string)($params['competencia_fluxo_caixa'] ?? '');
        $fechamento_fluxo_caixa  = (int)($params['fechamento_fluxo_caixa'] ?? -1);
        $tipo_ordenacao          = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao         = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('fluxo_caixa.uuid', $uuid);
            })
            ->when($competencia_fluxo_caixa, function ($query) use ($competencia_fluxo_caixa) {
                $query->where('fluxo_caixa.competencia_fluxo_caixa', $competencia_fluxo_caixa);
            })
            ->when(in_array($fechamento_fluxo_caixa, [0, 1]), function ($query) use ($fechamento_fluxo_caixa) {
                $query->where('fluxo_caixa.fechamento_fluxo_caixa', $fechamento_fluxo_caixa);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('fluxo_caixa.competencia_fluxo_caixa');
            });
    }
}
