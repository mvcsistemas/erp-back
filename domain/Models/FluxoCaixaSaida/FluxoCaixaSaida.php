<?php

namespace MVC\Models\FluxoCaixaSaida;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class FluxoCaixaSaida extends MVCModel {

    use HasUuid;

    protected $table      = 'fluxo_caixa_saida';
    protected $primaryKey = 'id_fluxo_caixa_saida';
    protected $guarded    = ['id_fluxo_caixa_saida'];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('fluxo_caixa_saida.uuid', $uuid);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('fluxo_caixa_saida.data_fluxo_caixa_saida');
            });
    }
}
