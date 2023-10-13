<?php

namespace MVC\Models\Dre;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Dre extends MVCModel {

    use HasUuid;

    protected $table      = 'dre';
    protected $primaryKey = 'id_dre';
    protected $guarded    = ['id_dre'];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('dre.uuid', $uuid);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('dre.data_dre');
            });
    }
}
