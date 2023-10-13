<?php

namespace MVC\Models\DreItens;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class DreItens extends MVCModel {

    use HasUuid;

    protected $table      = 'dre_itens';
    protected $primaryKey = 'id_dre_item';
    protected $guarded    = ['id_dre_item'];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('dre_itens.uuid', $uuid);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('dre_itens.dsc_dre_item');
            });
    }
}
