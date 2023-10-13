<?php

namespace MVC\Models\CadTipoSaida;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadTipoSaida extends MVCModel {

    use HasUuid;

    protected $table      = 'cad_tipo_saida';
    protected $primaryKey = 'id_tipo_saida';
    protected $guarded    = ['id_tipo_saida'];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('cad_tipo_saida.uuid', $uuid);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('cad_tipo_saida.dsc_tipo_saida');
            });
    }
}
