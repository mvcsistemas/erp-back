<?php

namespace MVC\Models\CadGrupoFinanceiro;

use Illuminate\Database\Eloquent\Builder;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CadGrupoFinanceiro extends MVCModel {

    use HasUuid;

    protected $table      = 'cad_grupo_financeiro';
    protected $primaryKey = 'id_grupo_financeiro';
    protected $guarded    = ['id_grupo_financeiro'];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('cad_grupo_financeiro.uuid', $uuid);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('cad_grupo_financeiro.dsc_grupo_financeiro');
            });
    }
}
